<?php

namespace App\Http\Controllers;

use App\Models\CertificatTravail;
use App\Models\User;
use App\Services\NotificationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CertificatTravailController extends Controller
{
    protected $notificationService;

    public function __construct(NotificationService $notificationService)
    {
        $this->notificationService = $notificationService;
    }
    // Afficher la liste des certificats
    public function index()
    {
        $user = Auth::user();

        $certificats = in_array($user->permissionrh, ['rh', 'validateur'])
            ? CertificatTravail::all()
            : CertificatTravail::where('id_user', $user->id)->get();
    
        return view('certificats.index', compact('certificats'));
    }

    // Afficher le formulaire pour créer un certificat
    public function create()
    {
        $users = User::all(); // Récupérer tous les utilisateurs
        return view('certificats.create', compact('users'));
    }

    // Enregistrer un nouveau certificat
    public function store(Request $request)
    {
        $request->validate([
            'id_user' => 'required|exists:users,id',
            'date_debut' => 'required|date',
            'date_fin' => 'required|date',
            'type_contrat' => 'required|in:CDI,CDD,Autre',
        ]);

        $certificat = CertificatTravail::create([
            'id_user' => $request->id_user,
            'date_debut' => $request->date_debut,
            'date_fin' => $request->date_fin,
            'type_contrat' => $request->type_contrat,
        ]);

        // Envoyer notification aux RH, supérieurs et validateurs
        $this->notificationService->notifyNewRequest($certificat, 'certificat de travail', Auth::user());

        return redirect()->route('certificats.index')->with('success', 'Certificat de travail créé avec succès.');
    }

    // Afficher un certificat spécifique
    public function show($id)
    {
        $certificat = CertificatTravail::findOrFail($id);
        return view('certificats.show', compact('certificat'));
    }

    // Afficher le formulaire pour modifier un certificat
    public function edit($id)
    {
        $certificat = CertificatTravail::findOrFail($id);
        $users = User::all();
        return view('certificats.edit', compact('certificat', 'users'));
    }

    // Mettre à jour un certificat existant
    public function update(Request $request, $id)
    {
        $request->validate([
            'id_user' => 'required|exists:users,id',
            'date_debut' => 'required|date',
            'date_fin' => 'required|date',
            'type_contrat' => 'required|in:CDI,CDD,Autre',
        ]);

        $certificat = CertificatTravail::findOrFail($id);
        $certificat->update([
            'id_user' => $request->id_user,
            'date_debut' => $request->date_debut,
            'date_fin' => $request->date_fin,
            'type_contrat' => $request->type_contrat,
        ]);

        return redirect()->route('certificats.index')->with('success', 'Certificat de travail mis à jour avec succès.');
    }

    // Supprimer un certificat
    public function destroy($id)
    {
        $certificat = CertificatTravail::findOrFail($id);
        $certificat->delete();

        return redirect()->route('certificats.index')->with('success', 'Certificat de travail supprimé avec succès.');
    }

    // Valider le certificat
    public function valider($id)
    {
        $certificat = CertificatTravail::findOrFail($id);
        $certificat->validation_directeur = true;
        $certificat->date_validation = now();
        $certificat->save();

        // Envoyer notification de validation à l'utilisateur
        $this->notificationService->notifyValidation($certificat, 'certificat de travail', true, Auth::user());

        return redirect()->route('certificats.index')->with('success', 'Certificat validé avec succès.');
    }

    // Rejeter le certificat
    public function rejeter($id)
    {
        $certificat = CertificatTravail::findOrFail($id);
        $certificat->validation_directeur = false;
        $certificat->date_validation = null;
        $certificat->save();

        // Envoyer notification de rejet à l'utilisateur
        $this->notificationService->notifyValidation($certificat, 'certificat de travail', false, Auth::user());

        return redirect()->route('certificats.index')->with('error', 'Certificat rejeté.');
    }
}

