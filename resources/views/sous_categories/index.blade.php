@extends('layouts.apprh')

@section('content')
<div class="container">
    <h2>Liste des Sous-Catégories</h2>

    <a href="{{ route('sous-categories.create') }}" class="btn btn-primary mb-3">Ajouter une Sous-Catégorie</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Catégorie</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($sousCategories as $sousCategorie)
                <tr>
                    <td>{{ $sousCategorie->nom }}</td>
                    <td>{{ $sousCategorie->categorie->nom }}</td>
                    <td>
                        <form action="{{ route('sous-categories.destroy', $sousCategorie->id) }}" method="POST">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-danger">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
