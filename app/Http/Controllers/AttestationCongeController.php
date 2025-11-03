<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AttestationConge;
use App\Models\DemandeDepartConges;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class AttestationCongeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();

        $attestations = in_array($user->permissionrh, ['rh', 'validateur'])
            ? AttestationConge::with(['user', 'demandeConge'])->get()
            : AttestationConge::with(['user', 'demandeConge'])->where('user_id', $user->id)->get();

        return view('attestations_conge.index', compact('attestations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Récupérer les demandes de congé validées
        $demandes = DemandeDepartConges::with('user')
            ->where('avis_superieur', true)
            ->whereDoesntHave('attestationConge')
            ->get();
        
        return view('attestations_conge.create', compact('demandes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'demande_conge_id' => 'required|exists:demandes_depart_conges,id',
        ]);

        $demande = DemandeDepartConges::findOrFail($request->demande_conge_id);
        
        // Calculer le nombre de jours
        $dateDebut = Carbon::parse($demande->date_debut);
        $dateFin = Carbon::parse($demande->date_fin);
        $nombreJours = $dateDebut->diffInDays($dateFin) + 1;
        
        AttestationConge::create([
            'demande_conge_id' => $demande->id,
            'user_id' => $demande->id_user,
            'date_fin_conge' => $demande->date_fin,
            'nombre_jours' => $nombreJours,
            'date_debut_periode' => $demande->date_debut,
            'date_fin_periode' => $demande->date_fin,
            'annee' => Carbon::parse($demande->date_debut)->year,
        ]);

        return redirect()->route('attestations_conge.index')
            ->with('success', 'Attestation de congé créée avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $attestation = AttestationConge::with(['user', 'demandeConge'])->findOrFail($id);
        return view('attestations_conge.show', compact('attestation'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $attestation = AttestationConge::findOrFail($id);
        $demandes = DemandeDepartConges::with('user')
            ->where('avis_superieur', true)
            ->get();
        
        return view('attestations_conge.edit', compact('attestation', 'demandes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'demande_conge_id' => 'required|exists:demandes_depart_conges,id',
        ]);

        $attestation = AttestationConge::findOrFail($id);
        $demande = DemandeDepartConges::findOrFail($request->demande_conge_id);
        
        // Calculer le nombre de jours
        $dateDebut = Carbon::parse($demande->date_debut);
        $dateFin = Carbon::parse($demande->date_fin);
        $nombreJours = $dateDebut->diffInDays($dateFin) + 1;
        
        $attestation->update([
            'demande_conge_id' => $demande->id,
            'user_id' => $demande->id_user,
            'date_fin_conge' => $demande->date_fin,
            'nombre_jours' => $nombreJours,
            'date_debut_periode' => $demande->date_debut,
            'date_fin_periode' => $demande->date_fin,
            'annee' => Carbon::parse($demande->date_debut)->year,
        ]);

        return redirect()->route('attestations_conge.index')
            ->with('success', 'Attestation de congé mise à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $attestation = AttestationConge::findOrFail($id);
        $attestation->delete();

        return redirect()->route('attestations_conge.index')
            ->with('success', 'Attestation de congé supprimée avec succès.');
    }

    /**
     * Valider l'attestation par le Directeur Exécutif
     */
    public function valider($id)
    {
        $attestation = AttestationConge::findOrFail($id);
        
        // Vérifier les permissions
        if (!in_array(Auth::user()->permissionrh, ['rh', 'valideur'])) {
            return redirect()->route('attestations_conge.index')
                ->with('error', 'Vous n\'êtes pas autorisé à valider cette attestation.');
        }

        $attestation->update([
            'valide_directeur' => true,
            'date_validation' => now(),
        ]);

        return redirect()->route('attestations_conge.index')
            ->with('success', 'Attestation validée par le Directeur Exécutif.');
    }

    /**
     * Rejeter l'attestation
     */
    public function rejeter($id)
    {
        $attestation = AttestationConge::findOrFail($id);
        
        // Vérifier les permissions
        if (!in_array(Auth::user()->permissionrh, ['rh', 'valideur'])) {
            return redirect()->route('attestations_conge.index')
                ->with('error', 'Vous n\'êtes pas autorisé à rejeter cette attestation.');
        }

        $attestation->update([
            'valide_directeur' => false,
            'date_validation' => now(),
        ]);

        return redirect()->route('attestations_conge.index')
            ->with('error', 'Attestation rejetée.');
    }
}
