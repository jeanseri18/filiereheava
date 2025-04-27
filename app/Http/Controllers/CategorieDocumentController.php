<?php
namespace App\Http\Controllers;

use App\Models\CategorieDocument;
use Illuminate\Http\Request;

class CategorieDocumentController extends Controller
{
    /**
     * Affiche la liste des catégories.
     */
    public function index()
    {
        $categories = CategorieDocument::all();
        return view('categories.index', compact('categories'));
    }

    /**
     * Affiche le formulaire de création d'une nouvelle catégorie.
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Enregistre une nouvelle catégorie en base de données.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'sous_famille' => 'nullable|string|max:255',
        ]);

        CategorieDocument::create($request->all());

        return redirect()->route('categories-documents.index')->with('success', 'Catégorie ajoutée avec succès.');
    }

    /**
     * Supprime une catégorie.
     */
    public function destroy($id)
    {
        $categorie = CategorieDocument::findOrFail($id);
        $categorie->delete();

        return redirect()->route('categories-documents.index')->with('success', 'Catégorie supprimée avec succès.');
    }
}
