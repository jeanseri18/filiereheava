@extends('layouts.apprh')

@section('content')
<div class="container">
    <div class="card custom-card">
        <div class="card-body">
    <h2>Ajouter une Sous-Catégorie</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('sous-categories.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="nom"><strong>Nom de la Sous-Catégorie :</strong></label>
            <input type="text" name="nom" id="nom" class="form-control" placeholder="Entrez le nom de la sous-catégorie" required>
        </div>

        <div class="form-group">
            <label for="categorie_id"><strong>Catégorie :</strong></label>
            <select name="categorie_id" id="categorie_id" class="form-control" required>
                <option value="">-- Sélectionner une Catégorie --</option>
                @foreach($categories as $categorie)
                    <option value="{{ $categorie->id }}">{{ $categorie->nom }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-success mt-3">Ajouter</button>
        <a href="{{ route('sous-categories.index') }}" class="btn btn-secondary mt-3">Retour</a>
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