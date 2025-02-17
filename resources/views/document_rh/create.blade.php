@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card custom-card">
        <div class="card-body">
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
    </div>
</div>

<!-- Styles personnalisés -->
<style>
.custom-card {
    border: 2px dashed #038C4F;
    /* Bordure en traits */
    border-radius: 8px;
    /* Coins arrondis */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    /* Légère ombre */
    padding: 20px;
    background-color: #f9f9f9;
    transition: transform 0.2s, box-shadow 0.2s;
}

.custom-card:hover {
    transform: translateY(-5px);
    /* Effet de survol */
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
}

.btn-success {
    background-color: #038C4F;
    border-color: #038C4F;
}

.btn-success:hover {
    background-color: #026838;
    border-color: #026838;
}

.form-label {
    font-weight: bold;
    color: #333;
}

.form-control {
    border: 1px solid #ddd;
    border-radius: 5px;
}

.form-control:focus {
    border-color: #038C4F;
    box-shadow: 0 0 5px rgba(3, 140, 79, 0.5);
}
</style>
@endsection