<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('service')->get();
        return view('users.index', compact('users'));
    }

    public function create()
    {
        $services = Service::all();
        return view('users.create', compact('services'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8',
            'role' => 'required|in:admin,employe,manager',
            'id_service' => 'required|exists:services,id',
            'is_validator' => 'boolean',
            'status' => 'required|in:actif,inactif',
        ]);

        User::create([
            'nom' => $request->nom,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'id_service' => $request->id_service,
            'is_validator' => $request->is_validator,
            'status' => $request->status,
        ]);

        return redirect()->route('users.index')->with('success', 'Utilisateur ajouté avec succès.');
    }

    public function edit(User $user)
    {
        $services = Service::all();
        return view('users.edit', compact('user', 'services'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role' => 'required|in:admin,employe,manager',
            'id_service' => 'required|exists:services,id',
            'is_validator' => 'boolean',
            'status' => 'required|in:actif,inactif',
        ]);

        $user->update($request->only(['nom', 'email', 'role', 'id_service', 'is_validator', 'status']));

        return redirect()->route('users.index')->with('success', 'Utilisateur mis à jour avec succès.');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'Utilisateur supprimé avec succès.');
    }
}

