<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use App\Models\User;
use App\Models\Direction;
use App\Models\Service;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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
      
        ]);

        $user->update([
            'nom' => $request->input('full_name'),
         
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
    public function updatePhoto(Request $request)
    {
        $request->validate([
            'photo' => 'required|image|mimes:jpeg,png,jpg|max:2048', // Max 2 MB
        ]);

        $user = Auth::user();

        // Supprimer l'ancienne photo si elle existe
        if ($user->file_url && Storage::exists($user->file_url)) {
            Storage::delete($user->file_url);
        }

        // Enregistrer la nouvelle photo
        $path = $request->file('photo')->store('profile_photos', 'public');

        // Mettre à jour le champ `file_url`
        $user->file_url = $path;
        $user->save();

        return redirect()->route('profile.edit')->with('success', 'Photo de profil mise à jour avec succès.');
    }
}
