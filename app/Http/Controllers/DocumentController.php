<?php

// app/Http/Controllers/DocumentController.php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\User;
use App\Models\ShareGroup;

use Illuminate\Http\Request;

class DocumentController extends Controller
{
    // Affiche la liste des documents
    public function index()
    {
        // Récupère tous les documents créés par l'utilisateur connecté
        $documents = Document::where('id_creator', auth()->id())->get();
    
        // Passe les documents à la vue
        return view('documents.index', compact('documents'));
    }
    
      // Afficher les documents en ajout
      public function added()
      {
          $documents = Document::where('id_creator', auth()->id())
                               ->where('status', 'en attente')
                               ->get();
          return view('documents.index', compact('documents'));
      }
  
      // Afficher les documents soumis
      public function submitted()
      {
          $documents = Document::where('id_creator', auth()->id())
                               ->where('status', 'soumis')
                               ->get();
          return view('documents.index', compact('documents'));
      }
  
      // Afficher les documents en attente
      public function pending()
      {
          $documents = Document::where('id_creator', auth()->id())
                               ->where('status', 'en attente')
                               ->get();
          return view('documents.index', compact('documents'));
      }
  
      // Afficher les documents validés
      public function validated()
      {
          $documents = Document::where('id_creator', auth()->id())
                               ->where('status', 'validé')
                               ->get();
          return view('documents.index', compact('documents'));
      }
  
      // Afficher les documents rejetés
      public function rejected()
      {
          $documents = Document::where('id_creator', auth()->id())
                               ->where('status', 'rejeté')
                               ->get();
          return view('documents.index', compact('documents'));
      }

    public function alldoc()
    {
        $documents = Document::all();
        return view('documents.index', compact('documents'));
    }
    // Affiche le formulaire de création d'un document
    public function create()
    {
        $users = User::all(); // Tous les utilisateurs
        $groups = ShareGroup::all(); // Tous les groupes de partage
        return view('documents.create', compact('users', 'groups'));
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'file_url' => 'required|string',
            'type_doc' => 'required|in:document,courrier entrant,courrier sortant',
            'type_share' => 'required|in:public,privé,groupe',
           // 'status' => 'required|in:en attente,validé,rejeté,archivé',
        ]);
      // Vérifier si l'utilisateur est authentifié
      if (!auth()->check()) {
        return redirect()->route('login')->with('error', 'Veuillez vous connecter pour créer un document.');
    }
        // Créez le document
        $document = Document::create([
            'nom' => $request->nom,
            'file_url' => $request->file_url,
            'id_creator' => auth()->id(),
            'type_doc' => $request->type_doc,
            'type_share' => $request->type_share,
            'status' => 'ajoute',
        ]);
    
        // Gestion du partage
        if ($request->type_share === 'privé' && $request->has('users')) {
            foreach ($request->users as $userId) {
                SharedUser::create([
                    'user_id' => $userId,
                    'document_id' => $document->id,
                ]);
            }
        } elseif ($request->type_share === 'groupe' && $request->has('groups')) {
            foreach ($request->groups as $groupId) {
                $group = ShareGroup::find($groupId);
                foreach ($group->members as $member) {
                    SharedUser::create([
                        'user_id' => $member->id,
                        'document_id' => $document->id,
                    ]);
                }
            }
        }
    
        return redirect()->route('documents.index')->with('success', 'Document créé et partagé avec succès.');
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

// app/Http/Controllers/DocumentController.php

public function update(Request $request, Document $document)
{
    $request->validate([
        'nom' => 'required|string|max:255',
        'file_url' => 'required|string',
        'type_doc' => 'required|in:document,courrier entrant,courrier sortant',
        'type_share' => 'required|in:public,privé,groupe',
    ]);

    // Mise à jour des informations du document
    $document->update([
        'nom' => $request->nom,
        'file_url' => $request->file_url,
        'type_doc' => $request->type_doc,
        'type_share' => $request->type_share,
    ]);

    // Mise à jour des utilisateurs ou groupes partagés en fonction du type de partage
    if ($request->type_share === 'privé') {
        // Supprimer les anciens partages et ajouter les nouveaux utilisateurs
        $document->sharedUsers()->delete();  // Supprimer tous les anciens partages

        if ($request->has('users')) {
            foreach ($request->users as $userId) {
                SharedUser::create([
                    'user_id' => $userId,
                    'document_id' => $document->id,
                ]);
            }
        }
    } elseif ($request->type_share === 'groupe') {
        // Supprimer les anciens partages et ajouter les nouveaux groupes
        $document->sharedUsers()->delete();  // Supprimer tous les anciens partages

        if ($request->has('groups')) {
            foreach ($request->groups as $groupId) {
                $group = ShareGroup::find($groupId);
                foreach ($group->members as $member) {
                    SharedUser::create([
                        'user_id' => $member->id,
                        'document_id' => $document->id,
                    ]);
                }
            }
        }
    }

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
