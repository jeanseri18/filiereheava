@extends('layouts.apprh')

@section('content')

<div class="container">
    <div class="card custom-card">
        <div class="card-body">
    <h1>Modifier la demande de congé</h1>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

    <form action="{{ route('demandes.update', $demande->id) }}" method="POST">
        @csrf
        @method('PUT')

   

        <div class="mb-3">
            <label>Service / Secteur</label>
            <input type="text" name="service_secteur" class="form-control" value="{{ $demande->service_secteur }}" required>
        </div>

        <div class="mb-3">
            <label>Motif</label>
            <textarea name="motif" class="form-control" rows="3" required>{{ $demande->motif }}</textarea>
        </div>

        <div class="mb-3">
            <label>Date de début</label>
            <input type="date" name="date_debut" class="form-control" value="{{ $demande->date_debut ? $demande->date_debut->format('Y-m-d') : '' }}" required>
            </div>

        <div class="mb-3">
            <label>Date de fin</label>
            <input type="date" name="date_fin" class="form-control" value="{{ $demande->date_fin ? $demande->date_fin->format('Y-m-d') : '' }}" required>
            </div>

        <div class="mb-3">
            <label>Nombre de jours ouvrables</label>
            <input type="number" name="nombre_jours_ouvrables" class="form-control" min="1" value="{{ $demande->nombre_jours_ouvrables }}" required>
        </div>

        <div class="mb-3">
            <label>Nombre de jours calendaires</label>
            <input type="number" name="nombre_jours_calendaires" class="form-control" min="1" value="{{ $demande->nombre_jours_calendaires }}" required>
        </div>

        <div class="mb-3">
            <label>Adresse de séjour</label>
            <input type="text" name="adresse_sejour" class="form-control" value="{{ $demande->adresse_sejour }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Mettre à jour</button>
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

