@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Détails du document : {{ $document->nom }}</h2>

        <ul class="list-group">
            <li class="list-group-item"><strong>Nom : </strong>{{ $document->nom }}</li>
            <li class="list-group-item"><strong>Fichier : </strong><a href="{{  Storage::url($document->file_url) }}" target="_blank">Voir le fichier</a></li>
            <li class="list-group-item"><strong>Type de document : </strong>{{ $document->type_doc }}</li>
            <li class="list-group-item"><strong>Type de partage : </strong>{{ $document->type_share }}</li>
            <li class="list-group-item"><strong>Statut : </strong>{{ $document->status }}</li>
            <li class="list-group-item"><strong>Créé par : </strong>{{ $document->creator->name }}</li>
        </ul>

        <a href="{{ route('documents.index') }}" class="btn btn-secondary mt-3">Retour à la liste</a>
    </div>
@endsection
