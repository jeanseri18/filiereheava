@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Modifier la sous-catégorie</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('sous-categories.update', $sousCategorie->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nom" class="form-label">Nom de la sous-catégorie</label>
            <input type="text" class="form-control" id="nom" name="nom" value="{{ old('nom', $sousCategorie->nom) }}" required>
        </div>

        <div class="mb-3">
            <label for="categorie_id" class="form-label">Catégorie</label>
            <select class="form-control" id="categorie_id" name="categorie_id" required>
                @foreach ($categories as $categorie)
                    <option value="{{ $categorie->id }}" {{ $sousCategorie->categorie_id == $categorie->id ? 'selected' : '' }}>
                        {{ $categorie->nom }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-success">Mettre à jour</button>
        <a href="{{ route('sous-categories.index') }}" class="btn btn-secondary">Annuler</a>
    </form>
</div>
@endsection
