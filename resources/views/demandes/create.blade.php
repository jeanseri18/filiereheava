@extends('layouts.apprh')

@section('content')
<div class="container">
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
            <input type="text" name="service_secteur" class="form-control" required>
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

        <button type="submit" class="btn btn-primary">Soumettre</button>
    </form>
</div>
@endsection
