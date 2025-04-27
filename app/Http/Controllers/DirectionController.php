<?php

// app/Http/Controllers/DirectionController.php
namespace App\Http\Controllers;

use App\Models\Direction;
use Illuminate\Http\Request;

class DirectionController extends Controller
{
    public function index()
    {
        $directions = Direction::all();
        return view('directions.index', compact('directions'));
    }

    public function create()
    {
        return view('directions.create');
    }

    public function store(Request $request)
    {
        $request->validate(['nom' => 'required', 'status' => 'required']);
        Direction::create($request->all());
        return redirect()->route('directions.index')->with('success', 'Direction créée avec succès.');
    }

    public function edit(Direction $direction)
    {
        return view('directions.edit', compact('direction'));
    }

    public function update(Request $request, Direction $direction)
    {
        $request->validate(['nom' => 'required', 'status' => 'required']);
        $direction->update($request->all());
        return redirect()->route('directions.index')->with('success', 'Direction mise à jour avec succès.');
    }

    public function destroy(Direction $direction)
    {
        $direction->delete();
        return redirect()->route('directions.index')->with('success', 'Direction supprimée avec succès.');
    }
}
