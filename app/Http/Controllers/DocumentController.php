<?php

// app/Http/Controllers/DocumentController.php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\User;
use App\Models\ShareGroup;
use App\Models\Share;
use App\Models\SharedUser;

use Illuminate\Http\Request;

class DocumentController extends Controller
{
    // Affiche la liste des documents
    public function index()
    {
        // Récupérer tous les documents créés par l'utilisateur ou partagés avec lui
        $documents = Document::where('id_creator', auth()->id())  // Documents créés par l'utilisateur
                            ->orWhereIn('id', Share::where('id_user', auth()->id())->pluck('id_document')) // Documents partagés avec l'utilisateur
                            ->get();

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
  
      public function sharedByMe()
      {
          // Récupérer tous les documents partagés par l'utilisateur (documents créés par l'utilisateur ou partagés via un groupe ou un utilisateur spécifique)
          $documents = Share::where('id_user', auth()->id())
                            ->orWhere('id_group', auth()->id())  // Si l'utilisateur appartient à un groupe partagé
                            ->with(['document', 'user', 'group'])  // Charger les relations (document, user, group)
                            ->get();
  
          return view('documents.index', compact('documents'));
      }
  
      // Afficher les documents partagés avec l'utilisateur
      public function sharedWithMe()
      {
          // Récupérer tous les documents partagés avec l'utilisateur (documents où l'utilisateur est un destinataire)
          $documents = Share::where('id_user', auth()->id())
                            ->with(['document', 'user', 'group'])  // Charger les relations
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
    // Validation des données
    $request->validate([
        'nom' => 'required|string|max:255',
        'file_url' => 'required|file|mimes:pdf,doc,docx,txt|max:2048', // Vérifie le fichier
        'type_doc' => 'required|in:document,courrier entrant,courrier sortant',
        'type_share' => 'required|in:public,privé,groupe', // Les options de partage
    ]);

    // Vérification si l'utilisateur est authentifié
    if (!auth()->check()) {
        return redirect()->route('login')->with('error', 'Veuillez vous connecter pour créer un document.');
    }

    // Enregistrer le fichier
    $filePath = $request->file('file_url')->store('documents', 'public');

    // Création du document
    $document = Document::create([
        'nom' => $request->nom,
        'file_url' => $filePath,  // Sauvegarde du chemin du fichier
        'id_creator' => auth()->id(),
        'type_doc' => $request->type_doc,
        'type_share' => $request->type_share,
        'status' => 'ajouté',  // Statut initial
    ]);

    // Gestion du partage selon le type
    if ($request->type_share === 'privé' && $request->has('users')) {
        // Partage avec des utilisateurs spécifiques
        foreach ($request->users as $userId) {
            Share::create([
                'id_user' => $userId,
                'id_document' => $document->id,
                'type_share' => 'utilisateur',
            ]);
        }
    } elseif ($request->type_share === 'groupe' && $request->has('groups')) {
        // Partage avec des groupes
        foreach ($request->groups as $groupId) {
            $group = ShareGroup::find($groupId);
            foreach ($group->members as $member) {
                Share::create([
                    'id_group' => $groupId,
                    'id_user' => $member->id,
                    'id_document' => $document->id,
                    'type_share' => 'groupe',
                ]);
            }
        }
    }

    // Retour à la liste des documents avec un message de succès
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
