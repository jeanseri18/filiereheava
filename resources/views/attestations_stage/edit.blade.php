@extends('layouts.apprh')

@section('content')
<div class="container">
    <div class="card custom-card">
        <div class="card-body">        <h1>Modifier l'Attestation de Stage</h1>
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

        <form action="{{ route('attestations_stage.update', $attestation->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="id_user">Utilisateur</label>
                <select name="id_user" id="id_user" class="form-control">
                    @foreach($users as $user)
                        <option value="{{ $user->id }}" @if($user->id == $attestation->id_user) selected @endif>
                            {{ $user->nom }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="duree_stage">Durée du stage (en mois)</label>
                <input type="number" name="duree_stage" id="duree_stage" class="form-control" value="{{ $attestation->duree_stage }}" required>
            </div>

            <div class="form-group">
                <label for="secteur">Secteur</label>
                <input type="text" name="secteur" id="secteur" class="form-control" value="{{ $attestation->secteur }}" required>
            </div>

            <div class="form-group">
                <label for="date_debut">Date de début</label>
                <input type="date" name="date_debut" id="date_debut" class="form-control" value="{{ $attestation->date_debut }}" required>
            </div>

            <div class="form-group">
                <label for="date_fin">Date de fin</label>
                <input type="date" name="date_fin" id="date_fin" class="form-control" value="{{ $attestation->date_fin }}" required>
            </div>

            <div class="form-group">
                <label for="lieu">Lieu</label>
                <input type="text" name="lieu" id="lieu" class="form-control" value="{{ $attestation->lieu }}" required>
            </div>
            <div class="mb-3">
            <label for="type_contrat" class="form-label">Type de contrat</label>
            <select name="type_contrat" id="type_contrat" class="form-control">
                <option value="CDI" {{ $attestation->type_contrat == 'CDI' ? 'selected' : '' }}>CDI</option>
                <option value="CDD" {{ $attestation->type_contrat == 'CDD' ? 'selected' : '' }}>CDD</option>
                <option value="Autre" {{ $attestation->type_contrat == 'Autre' ? 'selected' : '' }}>Autre</option>
            </select>
        </div>
            <br>
            <button type="submit" class="btn btn-success">Mettre à jour l'attestation</button>
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
