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
        $demandes = DemandeDepartConges::all();
        return view('demandes.index', compact('demandes'));
    }

    /**
     * Affiche le formulaire de création d'une demande.
     */
    public function create()
    {
        return view('demandes.create');
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
        ]);

        return redirect()->route('demandes.index')->with('success', 'Demande créée avec succès.');
    }
    /**
     * Affiche une demande spécifique.
     */
    public function show(DemandeDepartConges $demande)
    {
        return view('demandes.show', compact('demande'));
    }

    /**
     * Affiche le formulaire d'édition d'une demande.
     */
    public function edit(DemandeDepartConges $demande)
    {
        return view('demandes.edit', compact('demande'));
    }

    /**
     * Met à jour une demande.
     */
    public function update(Request $request, DemandeDepartConges $demande)
    {
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
        ]);

        $demande->update($request->only([
            'motif', 'date_debut', 'date_fin', 'nombre_jours_ouvrables', 'nombre_jours_calendaires', 'adresse_sejour'
        ]));

        return redirect()->route('demandes.index')->with('success', 'Demande mise à jour avec succès.');
    }
    /**
     * Supprime une demande.
     */
    public function destroy(DemandeDepartConges $demande)
    {
        $demande->delete();
        return redirect()->route('demandes.index')->with('success', 'Demande supprimée avec succès.');
    }
}
