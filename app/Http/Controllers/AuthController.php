<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Document;
use App\Models\History;

class AuthController extends Controller
{
    // Affiche le formulaire de connexion
    public function showLoginForm()
    {
        return view('welcome'); // Assurez-vous que votre vue est dans "resources/views/auth/login.blade.php"
    }

    // Gère la connexion
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            $request->session()->regenerate();
            return redirect()->route('menu');
        }

        return back()->withErrors([
            'email' => 'Les informations de connexion ne sont pas valides.',
        ]);
    }
    public function dashboard()
    {
        // Récupérez l'utilisateur connecté
        $user = auth()->user();
    
        // Vérifiez si l'utilisateur a un rôle avec accès global
        if (in_array($user->role, ['admin', 'pca', 'vise', 'directeurexecutif'])) {
            // Statistiques globales
            $totalDocuments = Document::count();
            $validatedDocuments = Document::where('status', 'validé')->count();
            $pendingDocuments = Document::where('status', 'en attente')->count();
            $rejectedDocuments = Document::where('status', 'rejeté')->count();
            $archivedDocuments = Document::where('status', 'archivé')->count();
            $recentActions = History::with(['user', 'document'])
                ->orderBy('action_date', 'desc')
                ->limit(10)
                ->get();
        } else {
            // Statistiques spécifiques à l'utilisateur connecté
            $totalDocuments = Document::where('id_creator', $user->id)->count();
            $validatedDocuments = Document::where('id_creator', $user->id)->where('status', 'validé')->count();
            $pendingDocuments = Document::where('id_creator', $user->id)->where('status', 'en attente')->count();
            $rejectedDocuments = Document::where('id_creator', $user->id)->where('status', 'rejeté')->count();
            $archivedDocuments = Document::where('id_creator', $user->id)->where('status', 'archivé')->count();
            $recentActions = History::with(['user', 'document'])
                ->where('id_user', $user->id)
                ->orderBy('action_date', 'desc')
                ->limit(10)
                ->get();
        }
    
        // Retourner la vue avec les données
        return view('dashboard.index', compact(
            'totalDocuments',
            'validatedDocuments',
            'pendingDocuments',
            'rejectedDocuments',
            'archivedDocuments',
            'recentActions'
        ));
    }
    
    

    // Déconnexion
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
