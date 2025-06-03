<?php

namespace App\Http\Controllers;

use App\Models\AttestationStage;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AttestationStageController extends Controller
{
    // Afficher la liste des attestations de stage

    public function index()
    {
        
            $user = Auth::user();
        
            $attestations = in_array($user->permissionrh, ['rh', 'validateur'])
                ? AttestationStage::all()
                : AttestationStage::where('id_user', $user->id)->get();
        
            return view('attestations_stage.index', compact('attestations'));
    
}
    

    // Afficher le formulaire de création
    public function create()
    {
        // Récupérer tous les utilisateurs
        $users = User::all();
        return view('attestations_stage.create', compact('users'));
    }
    

    // Enregistrer une nouvelle attestation de stage
    public function store(Request $request)
    {
        $request->validate([
            'id_user' => 'required|string',
            'duree_stage' => 'required|integer',
            'secteur' => 'required|string',
            'date_debut' => 'required|date',
            'date_fin' => 'required|date',
            'lieu' => 'required|string',
            'type_contrat' => 'required|in:CDI,CDD,Autre',

        ]);

        AttestationStage::create($request->all());

        return redirect()->route('attestations_stage.index')->with('success', 'Attestation de stage créée avec succès');
    }

    // Afficher une attestation spécifique
public function show($id)
{
        set_time_limit(300);

    $attestation = AttestationStage::findOrFail($id);
    $pdf = \PDF::loadView('attestations_stage.show', compact('attestation'));
      // Réduire la qualité pour améliorer les performances
    $pdf->setPaper('a4');
    $pdf->setOption('dpi', 96); // Réduire la résolution
    $pdf->setOption('defaultFont', 'DejaVu Sans');
    $pdf->setOption('isRemoteEnabled', false); // Désactiver les ressources distantes
    $pdf->setOption('debugKeepTemp', false);
    $pdf->setOption('debugCss', false);
    $pdf->setOption('debugLayout', false);
    
    return $pdf->stream('attestation_stage_'.$id.'.pdf');
}

    // Afficher le formulaire d'édition
    public function edit($id)
    {
        // Récupérer l'attestation à modifier et tous les utilisateurs
        $attestation = AttestationStage::findOrFail($id);
        $users = User::all();
        return view('attestations_stage.edit', compact('attestation', 'users'));
    }
    
    

    // Mettre à jour une attestation
    public function update(Request $request, $id)
    {
        $request->validate([
            'id_user' => 'required|string',
            'duree_stage' => 'required|integer',
            'secteur' => 'required|string',
            'date_debut' => 'required|date',
            'date_fin' => 'required|date',

            'lieu' => 'required|string',
            'type_contrat' => 'required|in:CDI,CDD,Autre',

        ]);
    
        $attestation = AttestationStage::findOrFail($id);
        $attestation->update($request->all());
    
        return redirect()->route('attestations_stage.index')->with('success', 'Attestation de stage mise à jour avec succès');
    }
    

    // Supprimer une attestation de stage
    public function destroy($id)
    {
        $attestation = AttestationStage::findOrFail($id);
        $attestation->delete();

        return redirect()->route('attestations_stage.index')->with('success', 'Attestation de stage supprimée avec succès');
    }

    public function validated($id)
    {
        $attestation = AttestationStage::findOrFail($id);
        
        // Appeler la méthode validateAttestation() dans le modèle
        $attestation->validation_directeur = true;
        $attestation->date_validation = now(); // Ajoutez la date de validation
        $attestation->save();
        return redirect()->route('attestations_stage.index')->with('success', 'Attestation validée avec succès');
    }

    // Méthode pour rejeter une attestation
    public function reject($id)
    {
        $attestation = AttestationStage::findOrFail($id);

        // Appeler la méthode rejectAttestation() dans le modèle
        $attestation->validation_directeur = false;
        $attestation->date_validation = null; // Annuler la date de validation
        $attestation->save();
        return redirect()->route('attestations_stage.index')->with('error', 'Attestation rejetée');
    }
}
