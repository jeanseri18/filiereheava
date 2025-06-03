@extends('layouts.apprh')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-md-8">
            <h1>Ajouter un nouvel employé</h1>
        </div>
        <div class="col-md-4 text-end">
            <a href="{{ route('personnel.index') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Retour à la liste
            </a>
        </div>
    </div>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card custom-card">
        <div class="card-header bg-success text-white">
            <h5 class="card-title mb-0">Formulaire d'ajout d'employé</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('personnel.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <!-- Informations principales -->
                    <div class="col-md-6">
                        <h4 class="mb-3">Informations personnelles</h4>

                        <div class="mb-3">
                            <label for="nom" class="form-label">Nom complet <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('nom') is-invalid @enderror" id="nom" name="nom" value="{{ old('nom') }}" required>
                            @error('nom')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Mot de passe <span class="text-danger">*</span></label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">Le mot de passe doit contenir au moins 8 caractères.</small>
                        </div>

                        <div class="mb-3">
                            <label for="fonction" class="form-label">Fonction <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('fonction') is-invalid @enderror" id="fonction" name="fonction" value="{{ old('fonction') }}" required>
                            @error('fonction')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="matricule" class="form-label">Matricule <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('matricule') is-invalid @enderror" id="matricule" name="matricule" value="{{ old('matricule') }}" required>
                            @error('matricule')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="numcnps" class="form-label">Numéro CNPS</label>
                            <input type="text" class="form-control @error('numcnps') is-invalid @enderror" id="numcnps" name="numcnps" value="{{ old('numcnps') }}">
                            @error('numcnps')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Autorisations et paramètres -->
                    <div class="col-md-6">
                        <h4 class="mb-3">Autorisations et paramètres</h4>

                        <div class="mb-3">
                            <label for="role" class="form-label">Rôle <span class="text-danger">*</span></label>
                            <select class="form-select @error('role') is-invalid @enderror" id="role" name="role" required>
                                <option value="">Sélectionner un rôle</option>
                                <option value="">Sélectionner un rôle</option>
                                <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Administrateur</option>
                                <option value="pca" {{ old('role') == 'pca' ? 'selected' : '' }}>PCA</option>
                                <option value="vise" {{ old('role') == 'vise' ? 'selected' : '' }}>Vise President</option>
                                <option value="directeurexecutif" {{ old('role') == 'directeurexecutif' ? 'selected' : '' }}>Directeur Executif</option>
                                <option value="manager" {{ old('role') == 'manager' ? 'selected' : '' }}>Manager</option>
                                <option value="secretariat" {{ old('role') == 'secretariat' ? 'selected' : '' }}>Secrétariat</option>
                                <option value="user" {{ old('role') == 'employe' ? 'selected' : '' }}>Employé</option>
                                <option value="stagiaire" {{ old('role') == 'stagiaire' ? 'selected' : '' }}>Stagiaire</option>
                            </select>
                            @error('role')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="permissionrh" class="form-label">Permission RH <span class="text-danger">*</span></label>
                            <select class="form-select @error('permissionrh') is-invalid @enderror" id="permissionrh" name="permissionrh" required>
                                <option value="">Sélectionner une permission</option>
                                <option value="rh" {{ old('permissionrh') == 'rh' ? 'selected' : '' }}>RH</option>
                                <option value="valideur" {{ old('permissionrh') == 'valideur' ? 'selected' : '' }}>Valideur</option>
                                <option value="superieur" {{ old('permissionrh') == 'superieur' ? 'selected' : '' }}>Supérieur</option>
                                <option value="demandeur" {{ old('permissionrh') == 'demandeur' ? 'selected' : '' }}>Demandeur</option>
                            </select>
                            @error('permissionrh')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="id_service" class="form-label">Service <span class="text-danger">*</span></label>
                            <select class="form-select @error('id_service') is-invalid @enderror" id="id_service" name="id_service" required>
                                <option value="">Sélectionner un service</option>
                                @foreach($services as $service)
                                    <option value="{{ $service->id }}" {{ old('id_service') == $service->id ? 'selected' : '' }}>
                                        {{ $service->nom_service }}
                                    </option>
                                @endforeach
                            </select>
                            @error('id_service')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="is_validator" class="form-label">Statut de validateur</label>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input @error('is_validator') is-invalid @enderror" id="is_validator" name="is_validator" value="1" {{ old('is_validator') ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_validator">Est validateur</label>
                            </div>
                            @error('is_validator')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">Cochez cette case si l'employé peut valider des demandes.</small>
                        </div>

                        <div class="mb-3">
                            <label for="status" class="form-label">Statut <span class="text-danger">*</span></label>
                            <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                                <option value="actif" {{ old('status') == 'actif' ? 'selected' : '' }}>Actif</option>
                                <option value="inactif" {{ old('status') == 'inactif' ? 'selected' : '' }}>Inactif</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="photo" class="form-label">Photo</label>
                            <input type="file" class="form-control @error('photo') is-invalid @enderror" id="photo" name="photo" accept="image/*">
                            @error('photo')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">Formats acceptés: JPG, PNG, GIF. Taille max: 2MB.</small>
                        </div>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-12 text-center">
                        <button type="submit" class="btn btn-success">
                            <i class="bi bi-plus-circle"></i> Ajouter l'employé
                        </button>
                        <a href="{{ route('personnel.index') }}" class="btn btn-secondary">
                            <i class="bi bi-x-circle"></i> Annuler
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    .custom-card {
        border: 2px dashed #038C4F;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        transition: transform 0.2s, box-shadow 0.2s;
        margin-bottom: 20px;
    }

    .custom-card:hover {
        transform: translateY(-5px);
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
    
    .card-header {
        background-color: #038C4F !important;
    }
</style>
@endsection