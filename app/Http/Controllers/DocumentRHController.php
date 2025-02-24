<?php
// app/Http/Controllers/DocumentRhController.php

namespace App\Http\Controllers;

use App\Models\DocumentRh;
use App\Models\Categorie;
use App\Models\SousCategorie;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class DocumentRhController extends Controller
{
    // Afficher la liste des documents RH
    public function index()
    {
        $user = Auth::user();

        $documents = in_array($user->permissionrh, ['rh', 'validateur'])
            ? DocumentRh::all()
            : DocumentRh::where('user_id', $user->id)->get();
    
        return view('document_rh.index', compact('documents'));
    }

    // Afficher le formulaire de création
    public function create()
    {
        $users = User::all();
 
        $categories = Categorie::all();
        $sousCategories = SousCategorie::all();
        return view('document_rh.create', compact('users', 'categories', 'sousCategories'));}

    // Enregistrer un nouveau document RH
    public function store(Request $request)
    {
        $request->validate([
            'nom_document' => 'required|string',
            'categorie_id' => 'required|string',
            'sous_categorie_id' => 'nullable|string',
            'user_id' => 'required|exists:users,id',
            'file_url' => 'required',
        ]);

// Stocker le fichier dans le dossier "public"
        $filePath = $request->file('file_url')->store('documents_rh', 'public');

        DocumentRh::create([
            'nom_document' => $request->nom_document,
            'famille' => $request->categorie_id,
            'sous_famille' => $request->sous_categorie_id,
            'user_id' => $request->user_id,
            'file_url' => $filePath,
        ]);

        return redirect()->route('document_rh.index');
    }

    // Afficher le document spécifique
    public function show($id)
    {
        $document = DocumentRh::findOrFail($id);
        return response()->file(storage_path("app/public/{$document->file_url}"));
    }

    // Supprimer un document RH
    public function destroy($id)
    {
        $document = DocumentRh::findOrFail($id);

        // Supprimer le fichier
        Storage::delete('public/' . $document->file_url);

        // Supprimer le document de la base de données
        $document->delete();

        return redirect()->route('document_rh.index');
    }
    public function getSousCategories($id)
{
    $sousCategories = SousCategorie::where('categorie_id', $id)->get();
    return response()->json($sousCategories);
}
}
