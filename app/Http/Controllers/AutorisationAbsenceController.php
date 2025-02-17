<?php

namespace App\Http\Controllers;

use App\Models\AutorisationAbsence;
use App\Models\User; // Pour récupérer les utilisateurs
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AutorisationAbsenceController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $autorisations = in_array($user->permissionrh, ['rh', 'validateur'])
            ? AutorisationAbsence::all()
            : AutorisationAbsence::where('id_user', $user->id)->get();
    
        return view('autorisations.index', compact('autorisations'));
    }

    public function create()
    {
        $users = User::all(); // Récupérer tous les utilisateurs
        return view('autorisations.create', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_user' => 'required',
            'date_debut' => 'required|date',
            'date_fin' => 'required|date',
            'nombre_jours' => 'required|integer',
            'raison' => 'required',
        ]);

        AutorisationAbsence::create($request->all());
        return redirect()->route('autorisations.index');
    }

    public function show($id)
    {
        $autorisation = AutorisationAbsence::findOrFail($id);
        return view('autorisations.show', compact('autorisation'));
    }

    public function edit($id)
    {
        $autorisation = AutorisationAbsence::findOrFail($id);
        $users = User::all(); // Récupérer tous les utilisateurs
        return view('autorisations.edit', compact('autorisation', 'users'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'id_user' => 'required',
          
            'date_debut' => 'required|date',
            'date_fin' => 'required|date',
            'nombre_jours' => 'required|integer',
            'raison' => 'required',
        ]);

        $autorisation = AutorisationAbsence::findOrFail($id);
        $autorisation->update($request->all());
        return redirect()->route('autorisations.index');
    }

    public function destroy($id)
    {
        $autorisation = AutorisationAbsence::findOrFail($id);
        $autorisation->delete();
        return redirect()->route('autorisations.index');
    }
    public function valider($id)
    {
        // Trouver l'autorisation par son ID
        $autorisation = AutorisationAbsence::findOrFail($id);

        // Mettre à jour la validation du directeur
        $autorisation->validation_directeur = true;
        $autorisation->date_validation = now(); // Ajoutez la date de validation
        $autorisation->save();

        // Rediriger vers la liste des autorisations avec un message de succès
        return redirect()->route('autorisations.index')->with('success', 'L\'autorisation a été validée avec succès.');
    }

    public function rejeter($id)
    {
        // Trouver l'autorisation par son ID
        $autorisation = AutorisationAbsence::findOrFail($id);

        // Mettre à jour la validation du directeur
        $autorisation->validation_directeur = false;
        $autorisation->date_validation = null; // Annuler la date de validation
        $autorisation->save();

        // Rediriger vers la liste des autorisations avec un message de succès
        return redirect()->route('autorisations.index')->with('error', 'L\'autorisation a été rejetée.');
    }
}
