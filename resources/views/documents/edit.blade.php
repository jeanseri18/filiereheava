@extends('layouts.app')

@section('content')
<div class="container ">
    <div class="card shadow-sm">
        <div class="card-header  text-black">
            <h2 class="mb-0">Modifier le document : {{ $document->nom }}</h2>
        </div>
        <div class="card-body">
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('documents.update', $document->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="nom" class="form-label">Nom du document</label>
                    <input type="text" name="nom" id="nom" class="form-control" 
                           value="{{ old('nom', $document->nom) }}" placeholder="Entrez le nom du document" required>
                </div>

                <div class="mb-3">
                    <label for="file_url" class="form-label">Fichier</label>
                    <input type="file" name="file_url" id="file_url" class="form-control" 
                           value="{{ old('file_url', $document->file_url) }}" placeholder="Entrez l'URL du fichier" required>
                </div>

                <div class="mb-3">
                    <label for="type_doc" class="form-label">Type de document</label>
                    <select name="type_doc" id="type_doc" class="form-select" required>
                        <option value="document" {{ old('type_doc', $document->type_doc) == 'document' ? 'selected' : '' }}>Document</option>
                        <option value="courrier entrant" {{ old('type_doc', $document->type_doc) == 'courrier entrant' ? 'selected' : '' }}>Courrier entrant</option>
                        <option value="courrier sortant" {{ old('type_doc', $document->type_doc) == 'courrier sortant' ? 'selected' : '' }}>Courrier sortant</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="type_share" class="form-label">Type de partage</label>
                    <select name="type_share" id="type_share" class="form-select" required>
                        <option value="public" {{ old('type_share', $document->type_share) == 'public' ? 'selected' : '' }}>Public</option>
                        <option value="privé" {{ old('type_share', $document->type_share) == 'privé' ? 'selected' : '' }}>Privé</option>
                        <option value="groupe" {{ old('type_share', $document->type_share) == 'groupe' ? 'selected' : '' }}>Groupe</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="status" class="form-label">Statut</label>
                    <select name="status" id="status" class="form-select" required>
                        <option value="en attente" {{ old('status', $document->status) == 'en attente' ? 'selected' : '' }}>En attente</option>
                        <option value="validé" {{ old('status', $document->status) == 'validé' ? 'selected' : '' }}>Validé</option>
                        <option value="rejeté" {{ old('status', $document->status) == 'rejeté' ? 'selected' : '' }}>Rejeté</option>
                        <option value="archivé" {{ old('status', $document->status) == 'archivé' ? 'selected' : '' }}>Archivé</option>
                    </select>
                </div>

                <div>
                    <button type="submit" class="btn btn-success">Mettre à jour</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
