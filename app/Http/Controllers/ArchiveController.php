<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Document;
use App\Models\Archive;

class ArchiveController extends Controller
{
    public function index(Request $request)
    {
        $query = Document::query();
    
        // Ajout des filtres dynamiques
        if ($request->filled('nom')) {
            $query->where('nom', 'like', '%' . $request->input('nom') . '%');
        }
    
      /*  if ($request->filled('type_doc')) {
            $query->where('type_doc', $request->input('type_doc'));
        }*/
    
        if ($request->filled('type_share')) {
            $query->where('type_share', $request->input('type_share'));
        }
    
        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }
    
        $documents = $query->paginate(10);
    
        $typesDoc = ['document', 'courrier entrant', 'courrier sortant'];
        $typesShare = ['public', 'privé', 'groupe'];
        $statuses = ['ajouté', 'soumis', 'en attente', 'validé', 'rejeté', 'archivé'];
    
        return view('archives.index', compact('documents', 'typesDoc', 'typesShare', 'statuses'));
    }
    
    public function unarchiveDocument($id)
    {
        $document = Document::findOrFail($id);
    
        if ($document->status === 'archivé') {
            $document->status = $document->oldstatus;  // Remplacez par l'état qui convient
            $document->save();
    
            // Supprimer l'archive associée si nécessaire
            $archive = Archive::where('id_document', $document->id)->first();
            if ($archive) {
                $archive->delete();
            }
        }
    
        return redirect()->route('archives.index')->with('success', 'Document désarchivé avec succès.');
    }
    
    public function archiveDocument($id)
    {
        $document = Document::findOrFail($id);

        if ($document->status !== 'archivé') {
            $document->oldstatus= $document->status;

            $document->status = 'archivé';
            $document->save();

            Archive::create([
                'id_document' => $document->id,
                'archived_by' => auth()->id(),
                'archive_date' => now(),
            ]);
        }

        return redirect()->route('archives.index')->with('success', 'Document archivé avec succès.');
    }

    public function downloadDocument($id)
    {
        $document = Document::findOrFail($id);

        if (file_exists(public_path($document->file_url))) {
            return response()->download(public_path($document->file_url));
        }

        return redirect()->route('archives.index')->with('error', 'Fichier introuvable.');
    }
}
