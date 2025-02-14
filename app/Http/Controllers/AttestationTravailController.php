<?php
namespace App\Http\Controllers;

use App\Models\AttestationTravail;
use App\Models\User;
use Illuminate\Http\Request;

class AttestationTravailController extends Controller
{
    // Afficher la liste des attestations de travail
    public function index()
    {
        $attestations = AttestationTravail::all();
        return view('attestations_travail.index', compact('attestations'));
    }

    // Afficher le formulaire de création
    public function create()
    {
        $users = User::all();
        return view('attestations_travail.create', compact('users'));
    }

    // Enregistrer une nouvelle attestation de travail
    public function store(Request $request)
    {
        $request->validate([
            'id_user' => 'required|string',
            'numero_cnps' => 'required|string',
            'date_embauche' => 'required|date',
            'lieu_travail' => 'required|string',
        ]);

        AttestationTravail::create($request->all());

        return redirect()->route('attestations_travail.index')->with('success', 'Attestation de travail créée avec succès.');
    }

    // Afficher une attestation spécifique
    public function show($id)
    {
        $attestation = AttestationTravail::findOrFail($id);
        return view('attestations_travail.show', compact('attestation'));
    }

    // Afficher le formulaire d'édition
    public function edit($id)
    {
        $attestation = AttestationTravail::findOrFail($id);
        $users = User::all();
        return view('attestations_travail.edit', compact('attestation', 'users'));
    }

    // Mettre à jour une attestation
    public function update(Request $request, $id)
    {
        $request->validate([
            'id_user' => 'required|string',
            'numero_cnps' => 'required|string',
            'date_embauche' => 'required|date',
            'lieu_travail' => 'required|string',
        ]);

        $attestation = AttestationTravail::findOrFail($id);
        $attestation->update($request->all());

        return redirect()->route('attestations_travail.index')->with('success', 'Attestation de travail mise à jour.');
    }

    // Supprimer une attestation de travail
    public function destroy($id)
    {
        $attestation = AttestationTravail::findOrFail($id);
        $attestation->delete();

        return redirect()->route('attestations_travail.index')->with('success', 'Attestation supprimée.');
    }

    // Valider une attestation
    public function validateAttestation($id)
    {
        $attestation = AttestationTravail::findOrFail($id);
              // Appeler la méthode validateAttestation() dans le modèle
              $attestation->validation_directeur = true;
              $attestation->date_validation = now(); // Ajoutez la date de validation
              $attestation->save();

        return redirect()->route('attestations_travail.index')->with('success', 'Attestation validée.');
    }

    // Rejeter une attestation
    public function rejectAttestation($id)
    {
        $attestation = AttestationTravail::findOrFail($id);

        // Appeler la méthode rejectAttestation() dans le modèle
        $attestation->validation_directeur = false;
        $attestation->date_validation = null; // Annuler la date de validation
        $attestation->save();
        return redirect()->route('attestations_travail.index')->with('error', 'Attestation rejetée.');
    }
}
