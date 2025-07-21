<?php

// app/Http/Controllers/DocumentController.php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\User;
use App\Models\ShareGroup;
use App\Models\Share;
use App\Models\SharedUser;
use App\Services\NotificationService;

use Illuminate\Http\Request;

class DocumentController extends Controller
{
    protected $notificationService;

    public function __construct(NotificationService $notificationService)
    {
        $this->notificationService = $notificationService;
    }
    // Affiche la liste des documents
    public function index(Request $request)
    {
       
        $query = Document::where('id_creator', auth()->id())
        ->WhereIn('id', Share::where('id_user', auth()->id())->pluck('id_document'));
    
        // Appliquer le filtre de recherche si un terme est saisi
        if ($request->search && !empty($request->search)) {
            $search = $request->search;
            $query->Where('nom', 'LIKE', "%{$search}%");
          
        }
    
        $documents = $query->paginate(10);
   
        return view('documents.index', compact('documents'));
    }
      // Afficher les documents en ajout
      public function added(Request $request)
      {
          $query = Document::where('id_creator', auth()->id())
                           ->where('status', 'ajouté');
      
          if ($request->search && !empty($request->search)) {
              $query->where('nom', 'LIKE', "%{$request->search}%");
          }
      
          $documents = $query->paginate(10);
          return view('documents.index', compact('documents'));
      }
      
  
      // Afficher les documents soumis
      public function submitted(Request $request)
      {
          $query = Document::where('id_creator', auth()->id())
                           ->where('status', 'soumis');
      
          if ($request->search && !empty($request->search)) {
              $query->where('nom', 'LIKE', "%{$request->search}%");
          }
      
          $documents = $query->paginate(10);
          return view('documents.index', compact('documents'));
      }
  
      public function sharedByMe(Request $request)
      {
          $query = Share::where(function ($q) {
                              // Vérifier si l'utilisateur est un destinataire direct
                              $q->where('id_user', auth()->id()) ;

                          })
                          ->orWhereHas('group', function ($q) {
                              // Vérifier si l'utilisateur est soit le créateur, soit membre du groupe
                              $q->where(function ($q) {
                                  // Vérifie si l'utilisateur est le créateur du groupe
                                  $q->where('id_user', auth()->id())
                                    // ou si l'utilisateur est membre du groupe
                                    ->orWhereHas('members', function ($q) {
                                        $q->where('id_user', auth()->id());
                                    });
                              });
                          })
                          ->with(['document', 'user', 'group']);
      
          // Filtrer les documents si une recherche est effectuée
          if ($request->search && !empty($request->search)) {
              $query->whereHas('document', function ($q) use ($request) {
                  $q->where('nom', 'LIKE', "%{$request->search}%");
              });
          }
      
          $documents = $query->paginate(10);
          return view('documents.index', compact('documents'));
      }
      
      

  

      public function sharedWithMe(Request $request)
      {
          $query = Share::where(function ($q) {
                              // Vérifier si l'utilisateur est un destinataire direct
                              $q->where('id_user', auth()->id()) ;

                          })
                          ->orWhereHas('group', function ($q) {
                              // Vérifier si l'utilisateur est soit le créateur, soit membre du groupe
                              $q->where(function ($q) {
                                  // Vérifie si l'utilisateur est le créateur du groupe
                                  $q->where('id_user', auth()->id())
                                    // ou si l'utilisateur est membre du groupe
                                    ->orWhereHas('members', function ($q) {
                                        $q->where('id_user', auth()->id());
                                    });
                              });
                          })
                          ->with(['document', 'user', 'group']);
      
          // Filtrer les documents si une recherche est effectuée
          if ($request->search && !empty($request->search)) {
              $query->whereHas('document', function ($q) use ($request) {
                  $q->where('nom', 'LIKE', "%{$request->search}%");
              });
          }
      
          $documents = $query->paginate(10);
          return view('documents.index', compact('documents'));
      }
      // Afficher les documents en attente
      public function pending(Request $request)
      {
          $query = Document::where('id_creator', auth()->id())
                           ->where('status', 'en attente');
      
          if ($request->search && !empty($request->search)) {
              $query->where('nom', 'LIKE', "%{$request->search}%");
          }
      
          $documents = $query->paginate(10);
          return view('documents.index', compact('documents'));
      }
  
      // Afficher les documents validés
      public function validated(Request $request)
{
    $query = Document::where('id_creator', auth()->id())
                     ->where('status', 'validé');

    if ($request->search && !empty($request->search)) {
        $query->where('nom', 'LIKE', "%{$request->search}%");
    }

    $documents = $query->paginate(10);
    return view('documents.index', compact('documents'));
}
  
public function rejected(Request $request)
{
    $query = Document::where('id_creator', auth()->id())
                     ->where('status', 'rejeté');

    if ($request->search && !empty($request->search)) {
        $query->where('nom', 'LIKE', "%{$request->search}%");
    }

    $documents = $query->paginate(10);
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
'file_url' => 'required|file|mimes:pdf,doc,docx,txt,ppt,pptx,xls,xlsx,png,jpg,jpeg|max:200048',
//'type_doc' => 'required|in:document,courrier entrant,courrier sortant',
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

    // Envoyer notification de création aux RH, supérieurs et validateurs
    $this->notificationService->notifyDocumentCreation($document, auth()->user());

    // Gestion du partage selon le type
    if ($request->type_share === 'privé' && $request->has('users')) {
        // Partage avec des utilisateurs spécifiques
        Share::create([
            'id_user' => auth()->id(),
            'id_document' => $document->id,
            'type_share' => 'utilisateur',
        ]);
        foreach ($request->users as $userId) {
            Share::create([
                'id_user' => $userId,
                'id_document' => $document->id,
                'type_share' => 'utilisateur',
            ]);
            // Envoyer notification de partage à chaque utilisateur
            $sharedUser = User::find($userId);
            if ($sharedUser) {
                $this->notificationService->notifyDocumentShared($document, $sharedUser, auth()->user(), 'utilisateur');
            }
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
                // Envoyer notification de partage à chaque membre du groupe
                $this->notificationService->notifyDocumentShared($document, $member, auth()->user(), 'groupe');
            }
        }
    }

    // Retour à la liste des documents avec un message de succès
    return redirect()->route('documents.index')->with('success', 'Document créé et partagé avec succès.');
}

    


    // Affiche un document spécifique
    public function show(Document $document)
    {
          // Charger les utilisateurs et groupes associés au document
    $users = $document->sharedUsers;   // Récupérer les utilisateurs associés
    $groups = $document->sharedGroups; // Récupérer les groupes associés

    return view('documents.show', compact('document', 'users', 'groups'));
        return view('documents.show', compact('document'));
    }

    // Affiche le formulaire pour éditer un document
    public function edit(Document $document)
    {
        $users = User::all(); // Tous les utilisateurs
        $groups = ShareGroup::all(); // Tous les groupes de partage
    

        return view('documents.edit', compact('document','users', 'groups'));
    }

// app/Http/Controllers/DocumentController.php

public function update(Request $request, Document $document)
{



    // Validation des données
    $request->validate([
        'nom' => 'required|string|max:255',
        'file_url' => 'nullable|file|mimes:pdf,doc,docx,txt,ppt,pptx,xls,xlsx,png,jpg,jpeg|max:200048', // Vérifie le fichier
        //'type_doc' => 'required|in:document,courrier entrant,courrier sortant',
        'type_share' => 'required|in:public,privé,groupe', // Les options de partage
    ]);

    // Mise à jour du nom du document et du type de document
    $document->nom = $request->nom;
    $document->type_doc = $request->type_doc;
    $document->type_share = $request->type_share;

    // Mise à jour du fichier, si présent
    if ($request->hasFile('file_url')) {
        $filePath = $request->file('file_url')->store('documents', 'public');
        $document->file_url = $filePath;
    }

    // Enregistrer les modifications du document
    $document->save();

    // Suppression des anciennes partages existants
    Share::where('id_document', $document->id)->delete();

    // Gestion du partage selon le type
    if ($request->type_share === 'privé' && $request->has('users')) {
        // Partage avec des utilisateurs spécifiques
        foreach ($request->users as $userId) {
            Share::create([
                'id_user' => $userId,
                'id_document' => $document->id,
                'type_share' => 'privé',
            ]);
            // Envoyer notification de partage à chaque utilisateur
            $sharedUser = User::find($userId);
            if ($sharedUser) {
                $this->notificationService->notifyDocumentShared($document, $sharedUser, auth()->user(), 'utilisateur');
            }
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
                // Envoyer notification de partage à chaque membre du groupe
                $this->notificationService->notifyDocumentShared($document, $member, auth()->user(), 'groupe');
            }
        }
    }

    // Retour à la liste des documents avec un message de succès
    return redirect()->route('documents.index')->with('success', 'Document mis à jour et partagé avec succès.');
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

    public function updateStatus(Request $request, $id)
    {
        // Validation des données
        $request->validate([
            'status' => 'required|in:ajouté,soumis,en attente,validé,rejeté,archivé',
        ]);

        // Trouver le document
        $document = Document::findOrFail($id);

        // Mettre à jour le statut
        $document->oldstatus = $document->status; // Sauvegarder l'ancien statut
        $document->status = $request->status;
        $document->save();

        return redirect()->route('documents.index')->with('success', 'Statut mis à jour avec succès.');
    }

}