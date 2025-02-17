@extends('layouts.apprh')

@section('content')
<div class="container">
    <h2>Liste des Catégories</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('categories.create') }}" class="btn btn-primary mb-3">Ajouter une Catégorie</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Sous-Catégories</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($categories as $categorie)
                <tr>
                    <td>{{ $categorie->nom }}</td>
                    <td>
                        @foreach($categorie->sousCategories as $sousCategorie)
                            {{ $sousCategorie->nom }}<br>
                        @endforeach
                    </td>
                    <td>
                        <form action="{{ route('categories.destroy', $categorie->id) }}" method="POST">
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
