@extends('layouts.app')

<!-- Select2 CSS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@1.3.0/dist/select2-bootstrap4.min.css" rel="stylesheet" />

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
                    <input type="file" name="file_url" id="file_url" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="type_share" class="form-label">Type de partage</label>
                    <select name="type_share" id="type_share" class="form-select" required>
                        <option value="public">Public</option>
                        <option value="privé">Privé</option>
                        <option value="groupe">Groupe</option>
                    </select>
                </div>

                <!-- Sélection des utilisateurs pour le partage privé -->
                <div class="mb-3 d-none" id="user-select">
                    <label for="users" class="form-label">Utilisateurs</label>
                    <select class="form-control select2" name="users[]" id="users" multiple="multiple" data-placeholder="Sélectionner les utilisateurs">
                        @foreach($users as $user)
                            <option value="{{ $user->id }}">{{ $user->nom }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Sélection des groupes pour le partage avec un groupe -->
                <div class="mb-3 d-none" id="group-select">
                    <label for="groups" class="form-label">Groupes</label>
                    <select class="form-control select2" name="groups[]" id="groups" multiple="multiple" data-placeholder="Sélectionner les groupes">
                        @foreach($groups as $group)
                            <option value="{{ $group->id }}">{{ $group->nom }}</option>
                        @endforeach
                    </select>
                </div>

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
        border: 2px dashed #038C4F;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        padding: 20px;
        background-color: #f9f9f9;
        transition: transform 0.2s, box-shadow 0.2s;
    }

    .custom-card:hover {
        transform: translateY(-5px);
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

<!-- jQuery et Select2 JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    $(document).ready(function() {
        // Initialisation de Select2
        $('.select2').select2({
            theme: 'bootstrap4',
            placeholder: "Sélectionner",
            allowClear: true
        });

        // Affichage des champs dynamiquement en fonction du type de partage
        $('#type_share').on('change', function() {
            let type = $(this).val();
            $('#user-select, #group-select').addClass('d-none');

            if (type === 'privé') {
                $('#user-select').removeClass('d-none');
            } else if (type === 'groupe') {
                $('#group-select').removeClass('d-none');
            }
        });
    });
</script>

@endsection
