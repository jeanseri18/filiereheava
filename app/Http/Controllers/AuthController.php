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
            return redirect()->route('dashboard');
        }

        return back()->withErrors([
            'email' => 'Les informations de connexion ne sont pas valides.',
        ]);
    }
    public function dashboard()
    {
        // Récupérez les statistiques
        $totalDocuments = Document::count();
        $validatedDocuments = Document::where('status', 'validé')->count();
        $pendingDocuments = Document::where('status', 'en attente')->count();
        $rejectedDocuments = Document::where('status', 'rejeté')->count();
        $archivedDocuments = Document::where('status', 'archivé')->count();
        $recentActions = History::with(['user', 'document'])
        ->orderBy('action_date', 'desc')
        ->limit(10)
        ->get();
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
