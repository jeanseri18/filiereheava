<?php

namespace App\Http\Controllers;

use App\Models\DemandeDepartConges;
use App\Models\Service;
use App\Services\NotificationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DemandeDepartCongesController extends Controller
{
    protected $notificationService;

    public function __construct(NotificationService $notificationService)
    {
        $this->notificationService = $notificationService;
    }
    /**
     * Affiche la liste des demandes.
     */
    public function index()
    {
        $user = Auth::user();

        $demandes = in_array($user->permissionrh, ['rh', 'validateur'])
            ? DemandeDepartConges::all()
            : DemandeDepartConges::where('id_user', $user->id)->orwhere('id_superieur', $user->id)->get();
    
        return view('demandes.index', compact('demandes'));
    }

    /**
     * Affiche le formulaire de création d'une demande.
     */
    public function create()
    {
        $superieurs = \App\Models\User::where('permissionrh', 'superieur')->get(); // Tu peux ajuster cela
        $services = Service::all();
        return view('demandes.create', compact('superieurs','services'));
    }

    /**
     * Enregistre une nouvelle demande.
     */
    public function store(Request $request)
    {
        $request->validate([
            'service_secteur' => 'required|string|max:100',
            'motif' => 'required|string',
            'date_debut' => 'required|date',
            'date_fin' => 'required|date|after_or_equal:date_debut',
            'nombre_jours_ouvrables' => 'required|integer|min:1',
            'nombre_jours_calendaires' => 'required|integer|min:1',
            'adresse_sejour' => 'required|string',
            'id_superieur' => 'required|exists:users,id',
        ]);
    
        // Vérifier le nombre de demandes de congé de l'utilisateur dans l'année en cours
        $currentYear = now()->year;
        $demandesCount = DemandeDepartConges::where('id_user', Auth::id())
            ->whereYear('date_debut', $currentYear)
            ->count();
    
        // Limiter à 5 demandes par an
        if ($demandesCount >= 5) {
            return redirect()->route('demandes.index')->with('error', 'Vous avez atteint la limite de 5 demandes de congé par an.');
        }
    
        // Créer la demande si la limite n'est pas atteinte
        $demande = DemandeDepartConges::create([
            'id_user' => Auth::id(),
            'service_secteur' => $request->service_secteur,
            'motif' => $request->motif,
            'date_debut' => $request->date_debut,
            'date_fin' => $request->date_fin,
            'nombre_jours_ouvrables' => $request->nombre_jours_ouvrables,
            'nombre_jours_calendaires' => $request->nombre_jours_calendaires,
            'adresse_sejour' => $request->adresse_sejour,
            'id_superieur' => $request->id_superieur,
        ]);
    
        // Envoyer notification aux RH, supérieurs et validateurs
        $this->notificationService->notifyNewRequest($demande, 'demande de congé', Auth::user());
    
        return redirect()->route('demandes.index')->with('success', 'Demande créée avec succès.');
    }
    
    /**
     * Affiche une demande spécifique.
     */
public function show($id)
{
        set_time_limit(300);

    $demande = DemandeDepartConges::findOrFail($id);
    $pdf = \PDF::loadView('demandes.show', compact('demande'));
    $pdf->setPaper('a4');
    // Réduire la qualité pour améliorer les performances
    $pdf->setPaper('a4');
    $pdf->setOption('dpi', 96); // Réduire la résolution
    $pdf->setOption('defaultFont', 'DejaVu Sans');
    $pdf->setOption('isRemoteEnabled', false); // Désactiver les ressources distantes
    $pdf->setOption('debugKeepTemp', false);
    $pdf->setOption('debugCss', false);
    $pdf->setOption('debugLayout', false);
    
    return $pdf->stream('demande_conge_'.$id.'.pdf');
}
    public function showvalidedoc( $id)
    {
        $demande = DemandeDepartConges::findOrFail($id);

        return view('demandes.validedoc', compact('demande'));
    }

    /**
     * Affiche le formulaire d'édition d'une demande.
     */
    public function edit( $id)
    {
        $demande = DemandeDepartConges::findOrFail($id);
        $superieurs = \App\Models\User::where('permissionrh', 'superieur')->get(); // Tu peux ajuster cela

        return view('demandes.edit', compact('demande','superieurs'));
    }

    /**
     * Met à jour une demande.
     */
    public function update(Request $request, $id)
{
    $demande = DemandeDepartConges::findOrFail($id);

    // Vérifie si la demande appartient à l'utilisateur connecté
    if ($demande->id_user !== Auth::id()) {
        return redirect()->route('demandes.index')->with('error', 'Action non autorisée.');
    }

    // Validation des champs du formulaire
    $request->validate([
        'motif' => 'required|string',
        'date_debut' => 'required|date',
        'date_fin' => 'required|date|after_or_equal:date_debut',
        'nombre_jours_ouvrables' => 'required|integer|min:1',
        'nombre_jours_calendaires' => 'required|integer|min:1',
        'adresse_sejour' => 'required|string',
        'id_superieur' => 'required|exists:users,id',
    ]);

    // Mise à jour de la demande
    $demande->update($request->only([
        'motif', 
        'date_debut', 
        'date_fin', 
        'nombre_jours_ouvrables', 
        'nombre_jours_calendaires', 
        'adresse_sejour',
    ]));

    // Redirection avec message de succès
    return redirect()->route('demandes.index')->with('success', 'Demande mise à jour avec succès.');
}

    /**
     * Supprime une demande.
     */
    public function destroy( $id)
    {
        $demande = DemandeDepartConges::findOrFail($id);

        $demande->delete();
        return redirect()->route('demandes.index')->with('success', 'Demande supprimée avec succès.');
    }
    // Valider la demande de congé par le supérieur
    public function validateDemande($id)
    {
        $demande = DemandeDepartConges::findOrFail($id);

        // Vérifier si l'utilisateur connecté est bien le supérieur
        if ($demande->id_superieur != Auth::id() && !in_array(Auth::user()->permissionrh, ['rh', 'valideur'])) {
            return redirect()->route('demandes.index')->with('error', 'Vous n\'êtes pas autorisé à valider cette demande.');
        }

        // Mettre à jour la demande pour la valider
        $demande->avis_superieur = true;
        $demande->date_validation = now();
        $demande->save();

        // Envoyer notification de validation à l'utilisateur
        $this->notificationService->notifyValidation($demande, 'demande de congé', true, Auth::user());

        return redirect()->route('demandes.index')->with('success', 'Demande validée avec succès');
    }

    // Rejeter la demande de congé par le supérieur
    public function rejectDemande($id)
    {
        $demande = DemandeDepartConges::findOrFail($id);

        // Vérifier si l'utilisateur connecté est bien le supérieur
        if ($demande->id_superieur != Auth::id() && !in_array(Auth::user()->permissionrh, ['rh', 'valideur'])) {
            return redirect()->route('demandes.index')->with('error', 'Vous n\'êtes pas autorisé à rejeter cette demande.');
        }

        // Mettre à jour la demande pour la rejeter
        $demande->avis_superieur = false;
        $demande->date_validation = now();
        $demande->save();

        // Envoyer notification de rejet à l'utilisateur
        $this->notificationService->notifyValidation($demande, 'demande de congé', false, Auth::user());

        return redirect()->route('demandes.index')->with('error', 'Demande rejetée.');
    }

     // Mettre à jour la demande pour la rejeter
//      $demande->avis_superieur = false;
//      $demande->date_validation = now();
//      $demande->save();

//      return redirect()->route('demandes.index')->with('success', 'Demande rejetée avec succès');
//  }
}

