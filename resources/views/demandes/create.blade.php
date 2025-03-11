@extends('layouts.apprh')

@section('content')
<div class="container">
    <div class="card custom-card">
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
    <h1>Nouvelle demande de congé</h1>

    <form action="{{ route('demandes.store') }}" method="POST">
        @csrf

     
        <div class="mb-3">
            <label>Service / Secteur</label>
            <select name="service_secteur" id="service_secteur" class="form-control" required>
        @foreach($services as $service)
            <option value="{{ $service->id }}" >{{ $service->nom }}</option>
        @endforeach
    </select>
        </div>

        <div class="mb-3">
            <label>Motif</label>
            <textarea name="motif" class="form-control" rows="3" required></textarea>
        </div>

        <div class="mb-3">
            <label>Date de début</label>
            <input type="date" name="date_debut" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Date de fin</label>
            <input type="date" name="date_fin" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Nombre de jours ouvrables</label>
            <input type="number" name="nombre_jours_ouvrables" class="form-control" min="1" required>
        </div>

        <div class="mb-3">
            <label>Nombre de jours calendaires</label>
            <input type="number" name="nombre_jours_calendaires" class="form-control" min="1" required>
        </div>

        <div class="mb-3">
            <label>Adresse de séjour</label>
            <input type="text" name="adresse_sejour" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="id_superieur" class="form-label">Supérieur Hiérarchique</label>
            <select class="form-control" name="id_superieur" id="id_superieur">
                <option value="">Choisir un supérieur</option>
                @foreach($superieurs as $superieur)
                    <option value="{{ $superieur->id }}">{{ $superieur->nom }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-success">Soumettre</button>
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
