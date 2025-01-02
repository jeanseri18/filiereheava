<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use App\Models\User;
use App\Models\Direction;
use App\Models\Service;

class ProfileController extends Controller
{
    /**
     * Affiche la page de modification du profil.
     */
    public function edit()
    {
        $user = auth()->user();
        $directions = Direction::all(); // Récupère toutes les directions
        $services = Service::all(); // Récupère tous les services

        return view('parametres.index', compact('user', 'directions', 'services'));
    }
    /**
     * Met à jour les informations du profil utilisateur.
     */
    public function update(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'full_name' => 'required|string|max:255',
            'role' => 'required|string',
            'service' => 'nullable|string|max:255',
            'direction' => 'nullable|string|max:255',
        ]);

        $user->update([
            'nom' => $request->input('full_name'),
            'role' => $request->input('role'),
            'id_service' => $request->input('service'),
            'status' => $request->input('direction'),
        ]);

        return redirect()->route('profile.edit')->with('success', 'Informations mises à jour avec succès.');
    }

    /**
     * Met à jour le mot de passe de l'utilisateur.
     */
    public function updatePassword(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'current_password' => 'required',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        if (!Hash::check($request->input('current_password'), $user->password)) {
            return back()->withErrors(['current_password' => 'Le mot de passe actuel est incorrect.']);
        }

        $user->update([
            'password' => Hash::make($request->input('password')),
        ]);

        return redirect()->route('profile.edit')->with('success', 'Mot de passe mis à jour avec succès.');
    }
}
