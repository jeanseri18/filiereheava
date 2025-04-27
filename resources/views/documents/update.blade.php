@extends('layouts.app')

@section('content')
<div class="container ">
    <div class="card shadow-sm">
        <div class="card-header text-black">
            <h2 class="mb-0">Mettre à jour le document</h2>
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
                @method('PUT')  <!-- Méthode PUT pour mettre à jour -->

                <div class="mb-3">
                    <label for="nom" class="form-label">Nom du document</label>
                    <input type="text" name="nom" id="nom" class="form-control" value="{{ old('nom', $document->nom) }}" placeholder="Entrez le nom du document" required>
                </div>

                <div class="mb-3">
                    <label for="file_url" class="form-label">Fichier</label>
                    <input type="file" name="file_url" id="file_url" class="form-control" placeholder="Entrez l'URL du fichier">
                    <small class="form-text text-muted">Laissez vide si vous ne souhaitez pas modifier le fichier actuel.</small>
                </div>

                <div class="mb-3">
                    <label for="type_doc" class="form-label">Type de document</label>
                    <select name="type_doc" id="type_doc" class="form-select" required>
                        <option value="document" {{ $document->type_doc == 'document' ? 'selected' : '' }}>Document</option>
                        <!-- Option pour le courrier -->
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

                <!-- Section Utilisateurs pour le partage privé -->
                <div class="mb-3 d-none" id="user-select">
                    <label for="users" class="form-label">Utilisateurs</label>
                    <select name="users[]" id="users" class="form-select" multiple>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}" {{ in_array($user->id, $document->sharedUsers->pluck('id')->toArray()) ? 'selected' : '' }}>{{ $user->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Section Groupes pour le partage avec un groupe -->
                <div class="mb-3 d-none" id="group-select">
                    <label for="groups" class="form-label">Groupes</label>
                    <select name="groups[]" id="groups" class="form-select" multiple>
                        @foreach($groups as $group)
                            <option value="{{ $group->id }}" {{ in_array($group->id, $document->sharedGroups->pluck('id')->toArray()) ? 'selected' : '' }}>{{ $group->nom }}</option>
                        @endforeach
                    </select>
                </div>

                <script>
                    document.getElementById('type_share').addEventListener('change', function() {
                        const userSelect = document.getElementById('user-select');
                        const groupSelect = document.getElementById('group-select');
                        userSelect.classList.add('d-none');
                        groupSelect.classList.add('d-none');
                        if (this.value === 'privé') userSelect.classList.remove('d-none');
                        if (this.value === 'groupe') groupSelect.classList.remove('d-none');
                    });
                </script>

                <div>
                    <button type="submit" class="btn btn-success">Mettre à jour</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
