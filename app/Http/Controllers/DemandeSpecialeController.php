<?php

namespace App\Http\Controllers;

use App\Models\DemandeSpeciale;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DemandeSpecialeController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $demandes = in_array($user->permissionrh, ['rh', 'validateur'])
            ? DemandeSpeciale::with('user')->latest()->get()
            : DemandeSpeciale::where('user_id', $user->id)->with('user')->latest()->get();

        return view('demandes_speciales.index', compact('demandes'));
    }

    public function create()
    {
        return view('demandes_speciales.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'objet' => 'required|string|max:255',
        ]);

        DemandeSpeciale::create([
            'objet' => $request->objet,
            'user_id' => Auth::id(),
            'status' => 'en attente',
        ]);

        return redirect()->route('demandes_speciales.index')->with('success', 'Demande spéciale créée avec succès.');
    }

    public function show($id)
    {
        $demande_speciale=DemandeSpeciale::findOrFail($id);
        return view('demandes_speciales.show', compact('demande_speciale'));
    }

    public function destroy($id)
    {
        $demande_speciale=DemandeSpeciale::findOrFail($id);
        $demande_speciale->delete();
        return back()->with('success', 'Demande spéciale supprimée.');
    }
    public function valider($id)
{
    $demande_speciale=DemandeSpeciale::findOrFail($id);
    $demande_speciale->update(['status' => 'validé']);

    return redirect()->back()->with('success', 'Demande validée avec succès.');
}

public function annuler($id)
{
    $demande_speciale=DemandeSpeciale::findOrFail($id);
    $demande_speciale->update(['status' => 'annulé']);

    return redirect()->back()->with('success', 'Demande annulée.');
}

}
