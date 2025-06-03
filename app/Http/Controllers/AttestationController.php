<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Attestation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AttestationController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $autorisations = in_array($user->permissionrh, ['rh', 'validateur'])
            ?
        $attestations = Attestation::all():
        $attestations = Attestation::where('user_id', auth()->id())->get();
        return view('attestations.index', compact('attestations'));

    }

    public function create()
    {
        $users = User::where('status', 'actif')->get();
        return view('attestations.create', compact('users'));
    }

    public function store(Request $request)
{
    $request->validate([
        'user_id' => 'required|exists:users,id',  // Validation pour s'assurer que l'utilisateur existe
        'date_reprise' => 'required|date',
        'lieu' => 'required|string|max:255',
    ]);

    $user = User::find($request->user_id);

    Attestation::create([
        'user_id' => $request->user_id,  // Lier l'attestation à l'utilisateur sélectionné
        'nom' => $user->nom,
        'poste' => $user->fonction,  // Récupère le poste directement de l'utilisateur
        'service' => $user->service->nom,  // Récupère le service directement de l'utilisateur
        'date_reprise' => $request->date_reprise,
        'lieu' => $request->lieu,
    ]);

    return redirect()->route('attestations.index')->with('success', 'Attestation créée avec succès ✅');
}





    
public function show(Attestation $attestation)
{
        set_time_limit(300);

    // $this->authorize('view', $attestation);
    $pdf = \PDF::loadView('attestations.show', compact('attestation'));
    // Réduire la qualité pour améliorer les performances
    $pdf->setPaper('a4');
    $pdf->setOption('dpi', 96); // Réduire la résolution
    $pdf->setOption('defaultFont', 'DejaVu Sans');
    $pdf->setOption('isRemoteEnabled', false); // Désactiver les ressources distantes
    $pdf->setOption('debugKeepTemp', false);
    $pdf->setOption('debugCss', false);
    $pdf->setOption('debugLayout', false);
    return $pdf->stream('attestation_reprise_'.$attestation->id.'.pdf');
}

    public function destroy(Attestation $attestation)
    {
        // $this->authorize('delete', $attestation);
        $attestation->delete();

        return redirect()->route('attestations.index')->with('success', 'Attestation supprimée 🗑️');
    }
}
