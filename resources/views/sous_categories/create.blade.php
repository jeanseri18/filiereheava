@extends('layouts.apprh')

@section('content')
<div class="container">
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
@endsection
