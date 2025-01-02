<?php

namespace App\Http\Controllers;

use App\Models\Courrier;
use Illuminate\Http\Request;

class CourrierController extends Controller
{
    public function index()
    {
        $courriers = Courrier::all();
        return view('courriers.index', compact('courriers'));
    }

    public function create()
    {
        return view('courriers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'sender' => 'required|string|max:255',
            'receiver' => 'required|string|max:255',
            'attachment' => 'nullable|file|mimes:pdf,jpg,png,docx',
        ]);

        $attachmentPath = null;
        if ($request->hasFile('attachment')) {
            $attachmentPath = $request->file('attachment')->store('attachments', 'public');
        }

        Courrier::create([
            'title' => $request->title,
            'content' => $request->content,
            'sender' => $request->sender,
            'receiver' => $request->receiver,
            'attachment' => $attachmentPath,
        ]);

        return redirect()->route('courriers.index')->with('success', 'Courrier créé avec succès.');
    }

    public function show(Courrier $courrier)
    {
        return view('courriers.show', compact('courrier'));
    }
}
