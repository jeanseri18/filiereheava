<?php

namespace App\Http\Controllers;

use App\Models\ShareGroup;
use App\Models\User;
use Illuminate\Http\Request;

class ShareGroupController extends Controller
{public function index()
    {
        $user = auth()->user(); // Utilisateur connecté
    
        // Vérifiez si l'utilisateur a un rôle global
        if (in_array($user->role, ['admin', 'pca', 'vise', 'directeurexecutif'])) {
            // Récupérer tous les groupes
            $groups = ShareGroup::with('creator', 'members')->get();
        } else {
            // Récupérer les groupes créés par l'utilisateur ou dont il est membre
            $groups = ShareGroup::with('creator', 'members')
                ->where('id_user', $user->id) // Groupes créés par l'utilisateur
                ->orWhereHas('members', function ($query) use ($user) {
                    $query->where('id_user', $user->id); // Groupes où l'utilisateur est membre
                })
                ->get();
        }
    
        return view('share_groups.index', compact('groups'));
    }
    

    public function create()
    {
        return view('share_groups.create');
    }

    public function store(Request $request)
    {
        $user = auth()->user(); // Utilisateur connecté

        $request->validate(['nom' => 'required|string|max:255']);
        ShareGroup::create([
            'nom' => $request->nom,
            'id_user' =>   $user->id
    ]);

        return redirect()->route('share_groups.index')->with('success', 'Groupe créé avec succès.');
    }

    public function show($id)
    {
        $group = ShareGroup::findOrFail($id);
        $users = User::all();
        return view('share_groups.show', compact('group', 'users'));
    }

    public function addMember(Request $request, $id)
    {
        $group = ShareGroup::findOrFail($id);

        $request->validate(['id_user' => 'required|exists:users,id']);
        $group->members()->syncWithoutDetaching([$request->id_user]);

        return back()->with('success', 'Membre ajouté avec succès.');
    }

    public function removeMember($groupId, $userId)
    {
        $group = ShareGroup::findOrFail($groupId);
        $group->members()->detach($userId);

        return back()->with('success', 'Membre supprimé avec succès.');
    }
}
