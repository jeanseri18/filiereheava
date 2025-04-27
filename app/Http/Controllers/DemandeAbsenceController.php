<?php

namespace App\Http\Controllers;

use App\Models\DemandeAbsence;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DemandeAbsenceController extends Controller
{
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
    DemandeAbsence::create([
        'id_user' => Auth::id(),
        'nombre_jours' => $request->nombre_jours,
        'date_debut' => $request->date_debut,
        'date_fin' => $request->date_fin,
        'objet_demande' => $request->objet_demande,
        'date_creation' => now(),
        'id_superieur' => $request->id_superieur,
    ]);

    return redirect()->route('demandes_absence.user')->with('success', 'Demande d\'absence créée avec succès.');
}

    // Afficher les détails d'une demande
    public function show($id)
    {
        $demande = DemandeAbsence::findOrFail($id);
        return view('demandes_absence.show', compact('demande'));
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
        $demande->validation_superieur = false;
        $demande->date_validation = now();
        $demande->save();

        return redirect()->route('demandes_absence.index')->with('success', 'Demande rejetée avec succès');
    }
}
