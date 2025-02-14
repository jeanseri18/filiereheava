@extends('layouts.apprh')

@section('content')
<div class="container">
    <h1>Modifier la demande de congé</h1>

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
            <input type="date" name="date_debut" class="form-control" value="{{ $demande->date_debut }}" required>
        </div>

        <div class="mb-3">
            <label>Date de fin</label>
            <input type="date" name="date_fin" class="form-control" value="{{ $demande->date_fin }}" required>
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
@endsection
