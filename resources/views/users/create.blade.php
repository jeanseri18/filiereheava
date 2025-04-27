@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card shadow-lg custom-card">
        <div class="card-header text-black">
            <h1 class="mb-0">Ajouter un Utilisateur</h1>
        </div>
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

            <form action="{{ route('users.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="nom" class="form-label">Nom de l'utilisateur</label>
                    <input type="text" class="form-control" id="nom" name="nom" required placeholder="Entrez le nom">
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required placeholder="Entrez l'email">
                </div>
                <div class="mb-3">
                    <label for="matricule" class="form-label">Matricule</label>
                    <input type="text" class="form-control" id="matricule" name="matricule" required placeholder="Entrez le matricule">
                </div>
                <div class="mb-3">
                    <label for="numcnps" class="form-label">num cnps/ num de paie</label>
                    <input type="text" class="form-control" id="numcnps" name="numcnps" required placeholder="Entrez le matricule">
                </div>
                <div class="mb-3">
                    <label for="fonction" class="form-label">Fonction</label>
                    <input type="fonction" class="form-control" id="fonction" name="fonction" required placeholder="Entrez la fonction">
                </div>

                <div class="mb-3">
                    <label for="role" class="form-label">Rôle</label>
                    <select class="form-select" id="role" name="role" required>
                        <option value="">Sélectionner un rôle</option>
                        <option value="vise">vise president </option>
                        <option value="directeurexecutif">directeur executif </option>
                        <option value="pca">PCA </option>
                        <option value="secretariat">Secretariat </option>
                        <option value="admin">Administrateur</option>
                        <option value="user">Utilisateur</option>
                        <option value="manager">Responsable</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="permission" class="form-label">Permission RH</label>
                    <select class="form-select" id="permission" name="permission" required>
                        <option value="">Sélectionner un permission</option>
                        <option value="rh">rh </option>
                        <option value="demandeur">demandeur</option>
                        <option value="valideur">valideur </option>
                        <option value="superieur">Superieur </option>

                    </select>
                </div>

                <div class="form-group mb-3">
    <label for="id_service">Service</label>
    <select name="id_service" id="id_service" class="form-control" required>
        @foreach($services as $service)
            <option value="{{ $service->id }}" >{{ $service->nom }}</option>
        @endforeach
    </select>
</div>
<div class="mb-3">
                    <label for="is_validator" class="form-label">Peut il valider des documents</label>
                    <select class="form-select" id="is_validator" name="is_validator" required>
                    <option value="1">Oui</option>
                    <option value="0">Non</option>
                    </select>
                </div>
<div class="mb-3">
                    <label for="password" class="form-label">Mot de passe </label>
                    <input type="text" class="form-control" id="password" name="password" required placeholder="Entrez le mot de passe">
                </div>
                <div class="mb-3">
                    <label for="status" class="form-label">Statut</label>
                    <select class="form-select" id="status" name="status" required>
                        <option value="1">Actif</option>
                        <option value="0">Inactif</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-success">Enregistrer</button>
                <a href="{{ route('users.index') }}" class="btn btn-secondary">Retour</a>
            </form>
        </div>
    </div>
</div>
@endsection

@push('styles')
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
@endpush
