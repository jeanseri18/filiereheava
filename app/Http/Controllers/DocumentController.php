<?php

// app/Http/Controllers/DocumentController.php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;

class DocumentController extends Controller
{
    // Affiche la liste des documents
    public function index()
    {
        $documents = Document::all();
        return view('documents.index', compact('documents'));
    }

    // Affiche le formulaire de création d'un document
    public function create()
    {
        return view('documents.create');
    }

    // Stocke un nouveau document
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'file_url' => 'required|string',
            'type_doc' => 'required|in:document,courrier entrant,courrier sortant',
            'type_share' => 'required|in:public,privé,groupe',
            'status' => 'required|in:en attente,validé,rejeté,archivé',
        ]);

        Document::create([
            'nom' => $request->nom,
            'file_url' => $request->file_url,
            'id_creator' => auth()->id(),
            'type_doc' => $request->type_doc,
            'type_share' => $request->type_share,
            'status' => $request->status,
        ]);

        return redirect()->route('documents.index')->with('success', 'Document créé avec succès');
    }

    // Affiche un document spécifique
    public function show(Document $document)
    {
        return view('documents.show', compact('document'));
    }

    // Affiche le formulaire pour éditer un document
    public function edit(Document $document)
    {
        return view('documents.edit', compact('document'));
    }

    // Met à jour un document existant
    public function update(Request $request, Document $document)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'file_url' => 'required|string',
            'type_doc' => 'required|in:document,courrier entrant,courrier sortant',
            'type_share' => 'required|in:public,privé,groupe',
            'status' => 'required|in:en attente,validé,rejeté,archivé',
        ]);

        $document->update([
            'nom' => $request->nom,
            'file_url' => $request->file_url,
            'type_doc' => $request->type_doc,
            'type_share' => $request->type_share,
            'status' => $request->status,
        ]);

        return redirect()->route('documents.index')->with('success', 'Document mis à jour avec succès');
    }

    // Supprime un document
    public function destroy(Document $document)
    {
        $document->delete();
        return redirect()->route('documents.index')->with('success', 'Document supprimé');
    }


    public function entrants()
    {
        $documents = Document::where('type_doc', 'courrier entrant')
                             ->orderBy('created_at', 'desc')
                             ->get();

        return view('documents.entrants', compact('documents'));
    }

    // Afficher les documents sortants
    public function sortants()
    {
        $documents = Document::where('type_doc', 'courrier sortant')
                             ->orderBy('created_at', 'desc')
                             ->get();

        return view('documents.sortants', compact('documents'));
    }
}
