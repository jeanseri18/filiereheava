@extends('layouts.apprh')

@section('content')
<div class="container">
    <div class="card custom-card">
        <div class="card-body">
    <h1>Nouvelle Demande d'Absence</h1>
    @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
    <form action="{{ route('demandes_absence.store') }}" method="POST">
        @csrf
 

        <div class="mb-3">
            <label for="nombre_jours" class="form-label">Nombre de Jours</label>
            <input type="number" class="form-control" name="nombre_jours" id="nombre_jours" required>
        </div>

        <div class="mb-3">
            <label for="date_debut" class="form-label">Date de Début</label>
            <input type="date" class="form-control" name="date_debut" id="date_debut" required>
        </div>

        <div class="mb-3">
            <label for="date_fin" class="form-label">Date de Fin</label>
            <input type="date" class="form-control" name="date_fin" id="date_fin" required>
        </div>

        <div class="mb-3">
            <label for="objet_demande" class="form-label">Objet de la Demande</label>
            <textarea class="form-control" name="objet_demande" id="objet_demande" rows="3" required></textarea>
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
<br>
        <button type="submit" class="btn btn-success">Soumettre</button>
    </form>
    <br>
    <a href="{{ route('demandes_absence.index') }}" class="btn btn-secondary mt-3">Retour à la liste</a>
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
