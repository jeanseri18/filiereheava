@extends('layouts.apprh')

@section('content')
<div class="container">
    <h2>Ajouter une Catégorie</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('categories.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="nom"><strong>Nom de la Catégorie :</strong></label>
            <input type="text" name="nom" id="nom" class="form-control" placeholder="Entrez le nom de la catégorie" required>
        </div>

        <button type="submit" class="btn btn-success mt-3">Ajouter</button>
        <a href="{{ route('categories.index') }}" class="btn btn-secondary mt-3">Retour</a>
    </form>
</div>
@endsection
