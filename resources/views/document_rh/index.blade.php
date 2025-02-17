@extends('layouts.apprh')

@section('content')
<div class="container">
    <h2>Liste des Documents RH</h2>
    <a href="{{ route('document_rh.create') }}" class="btn btn-primary mb-3">Ajouter un Document</a>

    <table class="table">
        <thead>
            <tr>
                <th>Nom du Document</th>
        
                <th>Utilisateur</th>
                <th>Catégorie</th>
                <th>Sous-Catégorie</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($documents as $document)
            <tr>
                <td>{{ $document->nom_document }}</td>
      
                <td>{{ $document->user->nom }}</td>
                <td>{{ $document->famille }}</td>
                <td>{{ $document->sous_famille }}</td>
                <td>
                    <a href="{{ route('document_rh.edit', $document->id) }}" class="btn btn-warning">Modifier</a>
                    <form action="{{ route('document_rh.destroy', $document->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Supprimer</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
