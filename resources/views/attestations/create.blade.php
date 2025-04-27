@extends('layouts.apprh')

@section('content')
<div class="container">
    <div class="card custom-card">
        <div class="card-body">
        <h1 class="text-2xl font-bold mb-4">Créer une Attestation 🆕</h1>
        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
        <form action="{{ route('attestations.store') }}" method="POST">
    @csrf
    <div class="form-group">
        <label for="user_id">Employé</label>
        <select name="user_id" id="user_id" class="form-control" onchange="updateUserInfo()">
            <option value="">Sélectionner un utilisateur</option>
            @foreach($users as $user)
                <option value="{{ $user->id }}" 
                        data-poste="{{ $user->poste }}" 
                        data-service="{{ $user->service->name }}">
                    {{ $user->nom }} - {{ $user->fonction }} - {{ $user->service->name }}
                </option>
            @endforeach
        </select>
    </div>



    <div class="form-group">
        <label for="date_reprise">Date de reprise</label>
        <input type="date" name="date_reprise" id="date_reprise" class="form-control" required>
    </div>

    <div class="form-group">
        <label for="lieu">Lieu</label>
        <input type="text" name="lieu" id="lieu" class="form-control" required>
    </div>

    <button type="submit" class="btn btn-primary">Créer l'attestation</button>
</form>



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


