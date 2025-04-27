<?php

namespace App\Http\Controllers;

use App\Models\OrdreMission;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrdreMissionController extends Controller
{
    public function index()
    {
        $user = Auth::user();
    
        if (in_array($user->permissionrh, ['rh', 'validateur'])) {
            $ordres = OrdreMission::with('user')->latest()->get(); // Tous
        } else {
            $ordres = OrdreMission::where('user_id', $user->id)->with('user')->latest()->get(); // Seulement ses propres
        }
    
        return view('ordres.index', compact('ordres'));
    }
    

    public function create()
    {
        $users = User::all();
        return view('ordres.create', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'lieu_mission' => 'required',
            'objet_mission' => 'required',
            'moyen_transport' => 'required',
            'date_depart' => 'required|date',
            'date_retour' => 'required|date',
            'lieu_creation' => 'required',
            'date_creation' => 'required|date',
        ]);
    
        // Trouver l'utilisateur sélectionné
        $user = User::findOrFail($request->user_id);
    
        // Créer manuellement l'ordre de mission
        OrdreMission::create([
            'user_id'         => $request->user_id,
            'emploi_occupe'   => $user->fonction, // Rempli automatiquement
            'lieu_mission'    => $request->lieu_mission,
            'objet_mission'   => $request->objet_mission,
            'moyen_transport' => $request->moyen_transport,
            'date_depart'     => $request->date_depart,
            'date_retour'     => $request->date_retour,
            'lieu_creation'   => $request->lieu_creation,
            'date_creation'   => $request->date_creation,
        ]);
    
        return redirect()->route('ordres.index')->with('success', 'Ordre de mission créé avec succès.');
    }
    

    public function show(OrdreMission $ordre)
    {
        return view('ordres.show', compact('ordre'));
    }

    public function destroy(OrdreMission $ordre)
    {
        $ordre->delete();
        return back()->with('success', 'Ordre de mission supprimé.');
    }
}
