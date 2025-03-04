<?php
namespace App\Http\Controllers;

use App\Models\SousCategorie;
use App\Models\Categorie;
use Illuminate\Http\Request;

class SousCategorieController extends Controller
{
    public function index()
    {
        $sousCategories = SousCategorie::with('categorie')->get();
        return view('sous_categories.index', compact('sousCategories'));
    }

    public function create()
    {
        $categories = Categorie::all();
        return view('sous_categories.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required',
            'categorie_id' => 'required|exists:categories,id'
        ]);

        SousCategorie::create($request->all());
        return redirect()->route('sous-categories.index')->with('success', 'Sous-catégorie ajoutée avec succès.');
    }

    public function destroy($id)
    {
        SousCategorie::findOrFail($id)->delete();
        return redirect()->route('sous-categories.index')->with('success', 'Sous-catégorie supprimée avec succès.');
    }
    public function edit($id)
{
    $sousCategorie = SousCategorie::findOrFail($id);
    $categories = Categorie::all();
    return view('sous_categories.edit', compact('sousCategorie', 'categories'));
}

public function update(Request $request, $id)
{
    $request->validate([
        'nom' => 'required',
        'categorie_id' => 'required|exists:categories,id'
    ]);

    $sousCategorie = SousCategorie::findOrFail($id);
    $sousCategorie->update($request->all());

    return redirect()->route('sous-categories.index')->with('success', 'Sous-catégorie mise à jour avec succès.');
}

}
