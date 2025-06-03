<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\DocumentRh;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PersonnelController extends Controller
{
    /**
     * Afficher la liste de tous les utilisateurs
     */
    public function index()
    {
        // Vérifier les permissions pour l'accès à cette page
        $currentUser = Auth::user();
        if (!in_array($currentUser->permissionrh, ['rh', 'valideur'])) {
            return redirect()->route('dashboardrh')->with('error', 'Vous n\'avez pas les permissions nécessaires.');
        }

        // Récupérer tous les utilisateurs avec leurs services
        $users = User::with('service')->get();
        
        return view('personnel.index', compact('users'));
    }

    /**
     * Afficher les détails d'un utilisateur spécifique
     */
    public function show($id)
    {
        // Vérifier les permissions
        $currentUser = Auth::user();
        if (!in_array($currentUser->permissionrh, ['rh', 'valideur']) && $currentUser->id != $id) {
            return redirect()->route('dashboardrh')->with('error', 'Vous n\'avez pas les permissions nécessaires.');
        }

        // Récupérer l'utilisateur avec ses relations
        $user = User::with([
            'service',
            'attestationsTravail',
            'certificatsTravail',
            'AttestationStages',
            'demandesAbsences',
            'demandesDepartConges',
            'autorisationsAbsences'
        ])->findOrFail($id);

        // Récupérer les documents RH associés à cet utilisateur
        $documents = DocumentRh::with(['categorie', 'sousCategorie'])
            ->where('user_id', $id)
            ->get();

        return view('personnel.show', compact('user', 'documents'));
    }

    /**
     * Afficher le formulaire de création d'un nouvel utilisateur
     */
    public function create()
    {
        // Vérifier les permissions
        $currentUser = Auth::user();
        if (!in_array($currentUser->permissionrh, ['rh', 'valideur'])) {
            return redirect()->route('dashboardrh')->with('error', 'Vous n\'avez pas les permissions nécessaires.');
        }

        // Récupérer les services pour le formulaire
        $services = Service::all();
        
        return view('personnel.create', compact('services'));
    }

    /**
     * Enregistrer un nouvel utilisateur
     */
    public function store(Request $request)
    {
        // Vérifier les permissions
        $currentUser = Auth::user();
        if (!in_array($currentUser->permissionrh, ['rh', 'valideur'])) {
            return redirect()->route('dashboardrh')->with('error', 'Vous n\'avez pas les permissions nécessaires.');
        }

        // Valider les données du formulaire
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'role' => 'required|string',
            'permissionrh' => 'required|string',
            'fonction' => 'required|string',
            'matricule' => 'required|string|unique:users',
            'numcnps' => 'nullable|string',
            'id_service' => 'required|exists:services,id',
            'is_validator' => 'boolean',
            'status' => 'required|string',
        ]);

        // Gérer l'upload de photo si présent
        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $filename = time() . '.' . $photo->getClientOriginalExtension();
            $photo->move(public_path('uploads/users'), $filename);
            $validated['file_url'] = 'uploads/users/' . $filename;
        }

        // Hasher le mot de passe
        $validated['password'] = Hash::make($validated['password']);
        
        // Créer l'utilisateur
        User::create($validated);

        return redirect()->route('personnel.index')
            ->with('success', 'Utilisateur créé avec succès.');
    }

    /**
     * Afficher le formulaire de modification d'un utilisateur
     */
    public function edit($id)
    {
        // Vérifier les permissions
        $currentUser = Auth::user();
        if (!in_array($currentUser->permissionrh, ['rh', 'valideur']) && $currentUser->id != $id) {
            return redirect()->route('dashboardrh')->with('error', 'Vous n\'avez pas les permissions nécessaires.');
        }

        $user = User::findOrFail($id);
        $services = Service::all();
        
        return view('personnel.edit', compact('user', 'services'));
    }

    /**
     * Mettre à jour un utilisateur
     */
    public function update(Request $request, $id)
    {
        // Vérifier les permissions
        $currentUser = Auth::user();
        if (!in_array($currentUser->permissionrh, ['rh', 'valideur']) && $currentUser->id != $id) {
            return redirect()->route('dashboardrh')->with('error', 'Vous n\'avez pas les permissions nécessaires.');
        }

        $user = User::findOrFail($id);

        // Valider les données
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$id,
            'role' => 'required|string',
            'permissionrh' => 'required|string',
            'fonction' => 'required|string',
            'matricule' => 'required|string|unique:users,matricule,'.$id,
            'numcnps' => 'nullable|string',
            'id_service' => 'required|exists:services,id',
            'is_validator' => 'boolean',
            'status' => 'required|string',
        ]);

        // Gérer le mot de passe s'il est fourni
        if ($request->filled('password')) {
            $validated['password'] = Hash::make($request->password);
        }

        // Gérer l'upload de photo si présent
        if ($request->hasFile('photo')) {
            // Supprimer l'ancienne photo si elle existe
            if ($user->file_url && file_exists(public_path($user->file_url))) {
                unlink(public_path($user->file_url));
            }
            
            $photo = $request->file('photo');
            $filename = time() . '.' . $photo->getClientOriginalExtension();
            $photo->move(public_path('uploads/users'), $filename);
            $validated['file_url'] = 'uploads/users/' . $filename;
        }

        // Mettre à jour l'utilisateur
        $user->update($validated);

        return redirect()->route('personnel.show', $user->id)
            ->with('success', 'Utilisateur mis à jour avec succès.');
    }

    /**
     * Supprimer un utilisateur
     */
    public function destroy($id)
    {
        // Vérifier les permissions
        $currentUser = Auth::user();
        if (!in_array($currentUser->permissionrh, ['rh', 'valideur'])) {
            return redirect()->route('dashboardrh')->with('error', 'Vous n\'avez pas les permissions nécessaires.');
        }

        $user = User::findOrFail($id);
        
        // Supprimer la photo si elle existe
        if ($user->file_url && file_exists(public_path($user->file_url))) {
            unlink(public_path($user->file_url));
        }
        
        $user->delete();

        return redirect()->route('personnel.index')
            ->with('success', 'Utilisateur supprimé avec succès.');
    }
}