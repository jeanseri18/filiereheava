@extends('layouts.app')

@section('content')
<div class="container ">

<div class="card custom-card">
    <div class="card-body">
        <h2 class="mb-0">Créer un nouveau document</h2>
        <hr/>
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
                <div>
                    @foreach($users as $user)
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" name="users[]" value="{{ $user->id }}" id="user-{{ $user->id }}">
                            <label class="form-check-label" for="user-{{ $user->id }}">{{ $user->nom }}</label>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Section Groupes pour le partage avec un groupe -->
            <div class="mb-3 d-none" id="group-select">
                <label for="groups" class="form-label">Groupes</label>
                <div>
                    @foreach($groups as $group)
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" name="groups[]" value="{{ $group->id }}" id="group-{{ $group->id }}">
                            <label class="form-check-label" for="group-{{ $group->id }}">{{ $group->nom }}</label>
                        </div>
                    @endforeach
                </div>
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
                <button type="submit" class="btn btn-success">Ajouter le document</button>
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
