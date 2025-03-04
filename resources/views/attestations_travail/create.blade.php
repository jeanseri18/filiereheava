@extends('layouts.apprh')

@section('content')
<div class="container">
    <div class="card custom-card">
        <div class="card-body">
    <h1>Créer une Attestation de Travail</h1>

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
    <form action="{{ route('attestations_travail.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Utilisateur</label>
            <select name="id_user" class="form-control" required>
                @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->nom }}</option>
                @endforeach
            </select>
        </div>
  

        <div class="mb-3">
            <label>Date d'embauche</label>
            <input type="date" name="date_embauche" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="type_contrat" class="form-label">Type de contrat</label>
            <select name="type_contrat" id="type_contrat" class="form-control">
                <option value="CDI">CDI</option>
                <option value="CDD">CDD</option>
                <option value="Autre">Autre</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Lieu de travail</label>
            <input type="text" name="lieu_travail" class="form-control" required>
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

