@extends('layouts.apprh')

@section('content')
<div class="container">
    <div class="card custom-card">
        <div class="card-body">
        <h1>Créer une nouvelle autorisation d'absence</h1>
    <!-- Affichage des erreurs de validation -->
    @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        <form action="{{ route('autorisations.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="id_user" class="form-label">Utilisateur</label>
                <select name="id_user" id="id_user" class="form-select">
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}">{{ $user->nom }}</option>
                    @endforeach
                </select>
            </div>

 
            <div class="mb-3">
                <label for="date_debut" class="form-label">Date de début</label>
                <input type="date" name="date_debut" id="date_debut" class="form-control">
            </div>

            <div class="mb-3">
                <label for="date_fin" class="form-label">Date de fin</label>
                <input type="date" name="date_fin" id="date_fin" class="form-control">
            </div>

            <div class="mb-3">
                <label for="nombre_jours" class="form-label">Nombre de jours</label>
                <input type="number" name="nombre_jours" id="nombre_jours" class="form-control">
            </div>

            <div class="mb-3">
                <label for="raison" class="form-label">Raison</label>
                <textarea name="raison" id="raison" class="form-control"></textarea>
            </div>
            <br>
            <button type="submit" class="btn btn-success">Enregistrer</button>
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
