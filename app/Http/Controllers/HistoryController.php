<?php

namespace App\Http\Controllers;

use App\Models\History; // Assurez-vous que ce modèle est importé
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    public function index()
    {
        // Récupérer tous les historiques triés par date de manière décroissante
        $histories = History::with(['document', 'user']) // Charger les relations document et user
                            ->orderBy('action_date', 'desc')
                            ->get();

        // Passer les données à la vue
        return view('history.index', compact('histories'));
    }
}
