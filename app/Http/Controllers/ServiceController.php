<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Direction;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::all();
        return view('services.index', compact('services'));
    }

    public function create()
    {
        $directions = Direction::where('status', 'actif')->get(); // Charger uniquement les directions actives
        return view('services.create', compact('directions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
//            'id_direction' => 'required|exists:directions,id',
        ]);

        Service::create($request->all());
        return redirect()->route('services.index')->with('success', 'Service créé avec succès.');
    }

    public function edit(Service $service)
    {
        $directions = Direction::where('status', 'actif')->get(); // Charger uniquement les directions actives
        return view('services.edit', compact('service', 'directions'));
    }

    public function update(Request $request, Service $service)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
//            'id_direction' => 'required|exists:directions,id',
        ]);

        $service->update($request->all());
        return redirect()->route('services.index')->with('success', 'Service mis à jour avec succès.');
    }

    public function destroy(Service $service)
    {
        if ($service->users()->exists()) {
            return redirect()->route('services.index')->with('error', 'Impossible de supprimer ce service car des utilisateurs y sont encore associés.');
        }
    
        $service->delete();
        return redirect()->route('services.index')->with('success', 'Service supprimé avec succès.');
    }
}
