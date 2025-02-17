@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Ajouter un Document RH</h2>
    @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
    <form action="{{ route('document_rh.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="nom_document">Nom du Document</label>
            <input type="text" name="nom_document" id="nom_document" class="form-control" required>
        </div>


        <div class="form-group">
            <label for="file_url">URL du fichier</label>
            <input type="file" name="file_url" id="file_url" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="user_id">Utilisateur</label>
            <select name="user_id" id="user_id" class="form-control" required>
                <option value="">Sélectionner un Utilisateur</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->nom }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="famille">Catégorie</label>
            <select name="famille" id="famille" class="form-control" required>
                <option value="">Sélectionner une Catégorie</option>
                @foreach($categories as $categorie)
                    <option value="{{ $categorie->id }}">{{ $categorie->nom }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="sous_famille">Sous-Catégorie</label>
            <select name="sous_famille" id="sous_famille" class="form-control" required>
                <option value="">Sélectionner une Sous-Catégorie</option>
                @foreach($sousCategories as $sousCategorie)
                    <option value="{{ $sousCategorie->id }}">{{ $sousCategorie->nom }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-success mt-3">Ajouter</button>
    </form>
</div>
@endsection
