<?php
namespace App\Http\Controllers;

use App\Models\Categorie;
use Illuminate\Http\Request;

class CategorieController extends Controller
{
    public function index()
    {
        $categories = Categorie::with('sousCategories')->get();
        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $request->validate(['nom' => 'required|unique:categories']);
        Categorie::create($request->all());
        return redirect()->route('categories.index')->with('success', 'Catégorie ajoutée avec succès.');
    }

    public function destroy($id)
    {
        Categorie::findOrFail($id)->delete();
        return redirect()->route('categories.index')->with('success', 'Catégorie supprimée avec succès.');
    }
    public function edit($id)
{
    $categorie = Categorie::findOrFail($id);
    return view('categories.edit', compact('categorie'));
}

public function update(Request $request, $id)
{
    $request->validate(['nom' => 'required|unique:categories,nom,'.$id]);
    
    $categorie = Categorie::findOrFail($id);
    $categorie->update($request->all());

    return redirect()->route('categories.index')->with('success', 'Catégorie mise à jour avec succès.');
}

}
