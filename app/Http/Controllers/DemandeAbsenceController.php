<?php

namespace App\Http\Controllers;

use App\Models\DemandeAbsence;
use App\Services\NotificationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DemandeAbsenceController extends Controller
{
    protected $notificationService;

    public function __construct(NotificationService $notificationService)
    {
        $this->notificationService = $notificationService;
    }
    // Afficher toutes les demandes d'absence
    public function index()
    {
        $user = Auth::user();

    $demandes = in_array($user->permissionrh, ['rh', 'validateur'])
        ? DemandeAbsence::all()
        : DemandeAbsence::where('id_user', $user->id)->orwhere('id_superieur', $user->id)->get();

    return view('demandes_absence.index', compact('demandes'));
    }

    // Afficher les demandes d'absence de l'utilisateur connecté
    public function userDemandes()
    {
        $demandes = DemandeAbsence::where('id_user', Auth::id())->get();
        return view('demandes_absence.user', compact('demandes'));
    }

    // Afficher le formulaire de création
    public function create()
    {
        // Récupérer les utilisateurs supérieurs pour la sélection
        $superieurs = \App\Models\User::where('permissionrh', 'superieur')->get(); // Tu peux ajuster cela
        return view('demandes_absence.create', compact('superieurs'));
    }

    // Enregistrer une nouvelle demande d'absence
    public function store(Request $request)
{
    // Validation des données
    $request->validate([
        'nombre_jours' => 'required|integer',
        'date_debut' => 'required|date',
        'date_fin' => 'required|date|after_or_equal:date_debut', // Vérification si la date de fin est après ou égale à la date de début
        'objet_demande' => 'required|string',
        'id_superieur' => 'required|exists:users,id',
    ]);

    // Vérifier le nombre de demandes d'absence de l'utilisateur pour l'année en cours
    $currentYear = now()->year; // Obtenir l'année actuelle
    $demandesCount = DemandeAbsence::where('id_user', Auth::id())
        ->whereYear('date_debut', $currentYear)
        ->count(); // Compter les demandes de l'utilisateur dans l'année en cours

    // Limiter à 5 demandes par an
  //  if ($demandesCount >= 5) {
        //return redirect()->route('demandes_absence.user')->with('error', 'Vous avez atteint la limite de 5 demandes d\'absence par an.');
   // }

    // Créer la demande d'absence si la limite n'est pas atteinte
    $demande = DemandeAbsence::create([
        'id_user' => Auth::id(),
        'nombre_jours' => $request->nombre_jours,
        'date_debut' => $request->date_debut,
        'date_fin' => $request->date_fin,
        'objet_demande' => $request->objet_demande,
        'date_creation' => now(),
        'id_superieur' => $request->id_superieur,
    ]);

    // Envoyer notification aux RH, supérieurs et validateurs
    $this->notificationService->notifyNewRequest($demande, 'demande d\'absence', Auth::user());

    return redirect()->route('demandes_absence.user')->with('success', 'Demande d\'absence créée avec succès.');
}

    // Afficher les détails d'une demande
    // public function show($id)
    // {
    //     $demande = DemandeAbsence::findOrFail($id);
    //     return view('demandes_absence.show', compact('demande'));
    // }

    public function show($id)
{
   // Augmenter la limite de temps d'exécution
    set_time_limit(300);
    
    $demande = DemandeAbsence::findOrFail($id);
    
    // Optimiser la génération du PDF
    $pdf = \PDF::loadView('demandes_absence.show', compact('demande'));
    
    // Réduire la qualité pour améliorer les performances
    $pdf->setPaper('a4');
    $pdf->setOption('dpi', 96); // Réduire la résolution
    $pdf->setOption('defaultFont', 'DejaVu Sans');
    $pdf->setOption('isRemoteEnabled', false); // Désactiver les ressources distantes
    $pdf->setOption('debugKeepTemp', false);
    $pdf->setOption('debugCss', false);
    $pdf->setOption('debugLayout', false);
    
    // Nom de fichier personnalisé
    $filename = 'demande_absence_'.$demande->id.'_'.date('Ymd').'.pdf';
    
    // Télécharger le PDF
    // return $pdf->download($filename);
    // Alternative: Afficher le PDF dans le navigateur
    return $pdf->stream($filename);
}

    // Modifier une demande d'absence
    public function edit($id)
    {
        $demande = DemandeAbsence::findOrFail($id);
        $superieurs = \App\Models\User::where('permissionrh', 'superieur')->get(); // Adapter à tes besoins
        return view('demandes_absence.edit', compact('demande', 'superieurs'));
    }

    // Mettre à jour une demande d'absence
    public function update(Request $request, $id)
    {
        $demande = DemandeAbsence::findOrFail($id);

        $demande->update($request->all());

        return redirect()->route('demandes_absence.user')->with('success', 'Demande modifiée avec succès');
    }

    // Supprimer une demande d'absence
    public function destroy($id)
    {
        $demande = DemandeAbsence::findOrFail($id);
        $demande->delete();

        return redirect()->route('demandes_absence.user')->with('success', 'Demande supprimée avec succès');
    }

    // Valider la demande d'absence par le supérieur
    public function validateDemande($id)
    {
        $demande = DemandeAbsence::findOrFail($id);

        // Vérifier si l'utilisateur connecté est bien le supérieur
        if ($demande->id_superieur != Auth::id() && !in_array(Auth::user()->permissionrh, ['rh', 'valideur'])) {
            return redirect()->route('demandes_absence.index')->with('error', 'Vous n\'êtes pas autorisé à valider cette demande.');
        }

        // Mettre à jour la demande pour la valider
        $demande->validation_superieur = 1;
        $demande->date_validation = now();
        $demande->save();

        // Envoyer notification de validation à l'utilisateur
        $this->notificationService->notifyValidation($demande, 'demande d\'absence', true, Auth::user());

        return redirect()->route('demandes_absence.index')->with('success', 'Demande validée avec succès');
    }

    // Rejeter la demande d'absence par le supérieur
    public function rejectDemande($id)
    {
        $demande = DemandeAbsence::findOrFail($id);

        // Vérifier si l'utilisateur connecté est bien le supérieur
        if ($demande->id_superieur != Auth::id() && !in_array(Auth::user()->permissionrh, ['rh', 'valideur'])) {
            return redirect()->route('demandes_absence.index')->with('error', 'Vous n\'êtes pas autorisé à rejeter cette demande.');
        }

        // Mettre à jour la demande pour la rejeter
        $demande->validation_superieur = 0;
        $demande->date_validation = now();
        $demande->save();

        // Envoyer notification de rejet à l'utilisateur
        $this->notificationService->notifyValidation($demande, 'demande d\'absence', false, Auth::user());

        return redirect()->route('demandes_absence.index')->with('error', 'Demande rejetée.');
    }
}
