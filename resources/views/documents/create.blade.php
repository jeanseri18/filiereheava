@extends('layouts.app')

@section('content')
<div class="container ">
    <div class="card shadow-sm">
        <div class="card-header  text-blacck">
            <h2 class="mb-0">Créer un nouveau document</h2>
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

            <form action="{{ route('documents.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="mb-3">
        <label for="nom" class="form-label">Nom du document</label>
        <input type="text" name="nom" id="nom" class="form-control" placeholder="Entrez le nom du document" required>
    </div>

    <div class="mb-3">
        <label for="file_url" class="form-label">Fichier</label>
        <input type="file" name="file_url" id="file_url" class="form-control" placeholder="Entrez l'URL du fichier" required>
    </div>

    <div class="mb-3">
        <label for="type_doc" class="form-label">Type de document</label>
        <select name="type_doc" id="type_doc" class="form-select" required>
            <option value="document">Document</option>
            <!-- Option pour le courrier -->
        </select>
    </div>

    <div class="mb-3">
        <label for="type_share" class="form-label">Type de partage</label>
        <select name="type_share" id="type_share" class="form-select" required>
            <option value="public">Public</option>
            <option value="privé">Privé</option>
            <option value="groupe">Groupe</option>
        </select>
    </div>

    <!-- Section Utilisateurs pour le partage privé -->
    <div class="mb-3 d-none" id="user-select">
        <label for="users" class="form-label">Utilisateurs</label>
        <select name="users[]" id="users" class="form-select" multiple>
            @foreach($users as $user)
                <option value="{{ $user->id }}">{{ $user->nom }}</option>
            @endforeach
        </select>
    </div>

    <!-- Section Groupes pour le partage avec un groupe -->
    <div class="mb-3 d-none" id="group-select">
        <label for="groups" class="form-label">Groupes</label>
        <select name="groups[]" id="groups" class="form-select" multiple>
            @foreach($groups as $group)
                <option value="{{ $group->id }}">{{ $group->nom }}</option>
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
        <button type="submit" class="btn btn-success">Créer</button>
    </div>
</form>
        </div>
    </div>
</div>
@endsection
