<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DocumentsController extends Controller
{


    public function index() {
        return view('documents.index');
    }
    public function courriers() {
        return view('documents.courrier');
    }

    public function attente() {
        return view('documents.attente');
    }

    public function valide() {
        return view('documents.valide');
    }

    public function partages() {
        return view('documents.partages');
    }

    public function recherche() {
        return view('documents.recherche');
    }

    public function archives() {
        return view('documents.archives');
    }

    public function verification() {
        return view('documents.verification');
    }

    public function historique() {
        return view('documents.historique');
    }

    public function utilisateur() {
        return view('utilisateur.index');
    }

    public function ressourcesHumaines() {
        return view('ressources.index');
    }

    public function parametres() {
        return view('parametres.index');
    }
}
