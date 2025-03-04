<?php

namespace App\Http\Controllers;

use App\Models\Courrier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourrierController extends Controller
{
    public function index()
    {
        $userId = Auth::id(); // Récupère l'ID de l'utilisateur connecté
        $user = Auth::user(); // Récupère les informations de l'utilisateur connecté
    
        // Récupère l'ID du service de l'utilisateur connecté
        $userServiceId = $user->id_service;
    
        // Vérifie si l'utilisateur connecté est un 'manager'
        if ($user->role == 'manager') {
            // Si c'est un 'manager', récupère les courriers de tous les utilisateurs dans le même service
            $courriers = Courrier::where('id_user', $userId)
                ->orWhereHas('user', function ($query) use ($userServiceId) {
                    $query->where('id_service', $userServiceId);
                })
                ->get();
        } else {
            // Sinon, récupère uniquement les courriers créés par l'utilisateur connecté
            $courriers = Courrier::where('id_user', $userId)->get();
        }
    
        return view('courriers.index', compact('courriers'));
    }
    
    
    public function create()
    {
        return view('courriers.create');
    }

    public function store(Request $request)
    {
        $userId = Auth::id(); // Récupère l'ID de l'utilisateur connecté

        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'type' => 'required|string|max:255',
            'attachment' => 'nullable|file|mimes:pdf,doc,docx,txt,ppt,pptx,xls,xlsx,png,jpg,jpeg|max:200048',
        ]);

        $attachmentPath = null;
        if ($request->hasFile('attachment')) {
            $attachmentPath = $request->file('attachment')->store('attachments', 'public');
        }

        Courrier::create([
            'title' => $request->title,
            'content' => $request->content,
            'type' => $request->type,
            'attachment' => $attachmentPath,
            'id_user' =>  $userId,
        ]);

        return redirect()->route('courriers.index')->with('success', 'Courrier créé avec succès.');
    }

    public function show(Courrier $courrier)
    {   

        return view('courriers.show', compact('courrier'));
    }
}
