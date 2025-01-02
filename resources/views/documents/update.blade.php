@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card shadow-sm">
        <div class="card-header text-black">
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

            <form action="{{ route('documents.update', $document->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="nom" class="form-label">Nom du document</label>
                    <input type="text" name="nom" id="nom" class="form-control" value="{{ old('nom', $document->nom) }}" required>
                </div>

                <div class="mb-3">
                    <label for="file_url" class="form-label">Fichier</label>
                    <input type="text" name="file_url" id="file_url" class="form-control" value="{{ old('file_url', $document->file_url) }}" required>
                </div>

                <div class="mb-3">
                    <label for="type_doc" class="form-label">Type de document</label>
                    <select name="type_doc" id="type_doc" class="form-select" required>
                        <option value="document" {{ $document->type_doc == 'document' ? 'selected' : '' }}>Document</option>
                        <option value="courrier entrant" {{ $document->type_doc == 'courrier entrant' ? 'selected' : '' }}>Courrier entrant</option>
                        <option value="courrier sortant" {{ $document->type_doc == 'courrier sortant' ? 'selected' : '' }}>Courrier sortant</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="type_share" class="form-label">Type de partage</label>
                    <select name="type_share" id="type_share" class="form-select" required>
                        <option value="public" {{ $document->type_share == 'public' ? 'selected' : '' }}>Public</option>
                        <option value="privé" {{ $document->type_share == 'privé' ? 'selected' : '' }}>Privé</option>
                        <option value="groupe" {{ $document->type_share == 'groupe' ? 'selected' : '' }}>Groupe</option>
                    </select>
                </div>

                <div class="mb-3" id="user-share" style="{{ $document->type_share == 'privé' ? '' : 'display:none;' }}">
                    <label for="users" class="form-label">Sélectionner les utilisateurs</label>
                    <select name="users[]" id="users" class="form-select" multiple>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}" 
                                    {{ in_array($user->id, $document->sharedUsers->pluck('user_id')->toArray()) ? 'selected' : '' }}>
                                {{ $user->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3" id="group-share" style="{{ $document->type_share == 'groupe' ? '' : 'display:none;' }}">
                    <label for="groups" class="form-label">Sélectionner les groupes</label>
                    <select name="groups[]" id="groups" class="form-select" multiple>
                        @foreach($groups as $group)
                            <option value="{{ $group->id }}"
                                    {{ in_array($group->id, $document->sharedGroups->pluck('id_group')->toArray()) ? 'selected' : '' }}>
                                {{ $group->nom }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="status" class="form-label">Statut</label>
                    <select name="status" id="status" class="form-select" required>
                        <option value="en attente" {{ $document->status == 'en attente' ? 'selected' : '' }}>En attente</option>
                        <option value="validé" {{ $document->status == 'validé' ? 'selected' : '' }}>Validé</option>
                        <option value="rejeté" {{ $document->status == 'rejeté' ? 'selected' : '' }}>Rejeté</option>
                        <option value="archivé" {{ $document->status == 'archivé' ? 'selected' : '' }}>Archivé</option>
                    </select>
                </div>

                <div>
                    <button type="submit" class="btn btn-primary">Mettre à jour</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.getElementById('type_share').addEventListener('change', function () {
        var shareType = this.value;
        document.getElementById('user-share').style.display = (shareType === 'privé') ? '' : 'none';
        document.getElementById('group-share').style.display = (shareType === 'groupe') ? '' : 'none';
    });
</script>

@endsection
