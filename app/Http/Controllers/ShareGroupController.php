<?php

namespace App\Http\Controllers;

use App\Models\ShareGroup;
use App\Models\User;
use Illuminate\Http\Request;

class ShareGroupController extends Controller
{
    public function index()
    {
        $groups = ShareGroup::all();
        return view('share_groups.index', compact('groups'));
    }

    public function create()
    {
        return view('share_groups.create');
    }

    public function store(Request $request)
    {
        $request->validate(['nom' => 'required|string|max:255']);
        ShareGroup::create(['nom' => $request->nom]);

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
