@extends('layouts.apprh')

@section('content')
<div class="container">
    <div class="card custom-card">
        <div class="card-body">
            <h2>Modifier le Document RH</h2>

            @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('document_rh.update', $document->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="categorie">Catégorie</label>
                    <select name="categorie_id" id="categorie" class="form-control">
                        <option value="">Sélectionner une catégorie</option>
                        @foreach($categories as $categorie)
                            <option value="{{ $categorie->id }}" {{ $document->famille == $categorie->id ? 'selected' : '' }}>{{ $categorie->nom }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="sous_categorie">Sous-catégorie</label>
                    <select name="sous_categorie_id" id="sous_categorie" class="form-control mt-2">
                        <option value="">Sélectionner une sous-catégorie</option>
                        @foreach($sousCategories as $sous)
                            <option value="{{ $sous->id }}" {{ $document->sous_famille == $sous->id ? 'selected' : '' }}>{{ $sous->nom }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="nom_document">Nom du Document</label>
                    <input type="text" name="nom_document" value="{{ $document->nom_document }}" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="file_url">Fichier (laisser vide pour conserver l'actuel)</label>
                    <input type="file" name="file_url" id="file_url" class="form-control">
                    @if($document->file_url)
                        <a href="{{ asset('storage/' . $document->file_url) }}" class="btn btn-info mt-2" target="_blank">Voir le fichier actuel</a>
                    @endif
                </div>

                <div class="form-group">
                    <label for="user_id">Utilisateur</label>
                    <select name="user_id" class="form-control" required>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}" {{ $document->user_id == $user->id ? 'selected' : '' }}>{{ $user->nom }}</option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="btn btn-success mt-3">Mettre à jour</button>
            </form>
        </div>
    </div>
</div>
@endsection
