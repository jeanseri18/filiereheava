@extends('layouts.app')

@section('content')
<div class="container ">
    <div class="card custom-card">
    <div class="card-body">
            <h2 class="mb-4">Mettre à jour le document</h2>
       
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
                    <input type="file" name="file_url" id="file_url" class="form-control">
                </div>

                <div class="mb-3">
                    <label for="type_doc" class="form-label">Type de document</label>
                    <select name="type_doc" id="type_doc" class="form-select" required>
                        <option value="document" {{ $document->type_doc === 'document' ? 'selected' : '' }}>Document</option>
             <option value="image" {{ $document->type_doc === 'image' ? 'selected' : '' }}>image</option>
            <option value="tableux" {{ $document->type_doc === 'tableux' ? 'selected' : '' }}>Tableux</option>
            <option value="video" {{ $document->type_doc === 'video' ? 'selected' : '' }}>video</option>
            <option value="pdf" {{ $document->type_doc === 'pdf' ? 'selected' : '' }}>pdf</option>                    </select>
                </div>

                <div class="mb-3">
                    <label for="type_share" class="form-label">Type de partage</label>
                    <select name="type_share" id="type_share" class="form-select" required>
                        <option value="public" {{ $document->type_share === 'public' ? 'selected' : '' }}>Public</option>
                        <option value="privé" {{ $document->type_share === 'privé' ? 'selected' : '' }}>Privé</option>
                        <option value="groupe" {{ $document->type_share === 'groupe' ? 'selected' : '' }}>Groupe</option>
                    </select>
                </div>

                <!-- Section Utilisateurs pour le partage privé -->
                <div class="mb-3 {{ $document->type_share === 'privé' ? '' : 'd-none' }}" id="user-select">
                    <label for="users" class="form-label">Utilisateurs</label>
                    <select name="users[]" id="users" class="form-select" multiple>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}" {{ in_array($user->id, old('users', $document->shares->pluck('id_user')->toArray())) ? 'selected' : '' }}>{{ $user->nom }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Section Groupes pour le partage avec un groupe -->
                <div class="mb-3 {{ $document->type_share === 'groupe' ? '' : 'd-none' }}" id="group-select">
                    <label for="groups" class="form-label">Groupes</label>
                    <select name="groups[]" id="groups" class="form-select" multiple>
                        @foreach($groups as $group)
                            <option value="{{ $group->id }}" {{ in_array($group->id, old('groups', $document->shares->pluck('id_group')->toArray())) ? 'selected' : '' }}>{{ $group->nom }}</option>
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

<!-- Styles personnalisés -->
<style>
    .custom-card {
        border: 2px dashed #038C4F; /* Bordure en traits */
        border-radius: 8px; /* Coins arrondis */
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Légère ombre */
        padding: 20px;
        background-color: #f9f9f9;
        transition: transform 0.2s, box-shadow 0.2s;
    }

    .custom-card:hover {
        transform: translateY(-5px); /* Effet de survol */
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
    }

    .btn-success {
        background-color: #038C4F;
        border-color: #038C4F;
    }

    .btn-success:hover {
        background-color: #026838;
        border-color: #026838;
    }

    .form-label {
        font-weight: bold;
        color: #333;
    }

    .form-control {
        border: 1px solid #ddd;
        border-radius: 5px;
    }

    .form-control:focus {
        border-color: #038C4F;
        box-shadow: 0 0 5px rgba(3, 140, 79, 0.5);
    }
</style>
@endsection
