<?php

namespace App\Http\Controllers;

use App\Models\DemandeDepartConges;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DemandeDepartCongesController extends Controller
{
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
        $superieurs = \App\Models\User::where('role', 'manager')->get(); // Tu peux ajuster cela

        return view('demandes.create', compact('demande','superieurs'));
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

        DemandeDepartConges::create([
            'id_user' => Auth::id(),
            'service_secteur' => $request->service_secteur,
            'motif' => $request->motif,
            'date_debut' => $request->date_debut,
            'date_fin' => $request->date_fin,
            'nombre_jours_ouvrables' => $request->nombre_jours_ouvrables,
            'nombre_jours_calendaires' => $request->nombre_jours_calendaires,
            'adresse_sejour' => $request->adresse_sejour,
            'id_superieur' =>$request->id_superieur,

        ]);

        return redirect()->route('demandes.index')->with('success', 'Demande créée avec succès.');
    }
    /**
     * Affiche une demande spécifique.
     */
    public function show( $id)
    {
        $demande = DemandeDepartConges::findOrFail($id);

        return view('demandes.show', compact('demande'));
    }

    /**
     * Affiche le formulaire d'édition d'une demande.
     */
    public function edit( $id)
    {
        $superieurs = \App\Models\User::where('role', 'manager')->get(); // Tu peux ajuster cela

        return view('demandes.edit', compact('demande','superieurs'));
    }

    /**
     * Met à jour une demande.
     */
    public function update(Request $request,  $id)
    {
        $demande = DemandeDepartConges::findOrFail($id);

        if ($demande->id_user !== Auth::id()) {
            return redirect()->route('demandes.index')->with('error', 'Action non autorisée.');
        }

        $request->validate([
            'motif' => 'required|string',
            'date_debut' => 'required|date',
            'date_fin' => 'required|date|after_or_equal:date_debut',
            'nombre_jours_ouvrables' => 'required|integer|min:1',
            'nombre_jours_calendaires' => 'required|integer|min:1',
            'adresse_sejour' => 'required|string',
            'id_superieur'=> 'required|exists:users,id',
        ]);

        $demande->update($request->only([
            'motif', 'date_debut', 'date_fin', 'nombre_jours_ouvrables', 'nombre_jours_calendaires', 'adresse_sejour'
        ]));

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
 // Valider la demande d'absence par le supérieur
 public function validateDemande($id)
 {
     $demande = DemandeDepartConges::findOrFail($id);

     // Vérifier si l'utilisateur connecté est bien le supérieur
     if ($demande->id_superieur != Auth::id()) {
         return redirect()->route('demandes.index')->with('error', 'Vous n\'êtes pas autorisé à valider cette demande.');
     }

     // Mettre à jour la demande pour la valider
     $demande->avis_superieur = true;
     $demande->date_validation = now();
     $demande->save();

     return redirect()->route('demandes.index')->with('success', 'Demande validée avec succès');
 }

 // Rejeter la demande d'absence par le supérieur
 public function rejectDemande($id)
 {
     $demande = DemandeDepartConges::findOrFail($id);

     // Vérifier si l'utilisateur connecté est bien le supérieur
     if ($demande->id_superieur != Auth::id()) {
         return redirect()->route('demandes.index')->with('error', 'Vous n\'êtes pas autorisé à rejeter cette demande.');
     }

     // Mettre à jour la demande pour la rejeter
     $demande->avis_superieur = false;
     $demande->date_validation = now();
     $demande->save();

     return redirect()->route('demandes.index')->with('success', 'Demande rejetée avec succès');
 }
}

