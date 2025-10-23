@extends('layouts.apprh')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Modifier l'Attestation de Congé #{{ $attestation->id }}</h1>
        </div>
    </div>
    <br>
    
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card custom-card">
        <div class="card-body">
            <form action="{{ route('attestations_conge.update', $attestation->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="demande_conge_id" class="form-label">Demande de Congé <span class="text-danger">*</span></label>
                            <select class="form-select" id="demande_conge_id" name="demande_conge_id" required>
                                <option value="">Sélectionner une demande de congé</option>
                                @foreach($demandes as $demande)
                                    <option value="{{ $demande->id }}" {{ $attestation->demande_conge_id == $demande->id ? 'selected' : '' }}>
                                        {{ $demande->user->nom }} {{ $demande->user->prenom }} - 
                                        Du {{ $demande->date_debut->format('d/m/Y') }} au {{ $demande->date_fin->format('d/m/Y') }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="date_fin_conge" class="form-label">Date de Fin du Congé <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" id="date_fin_conge" name="date_fin_conge" value="{{ $attestation->date_fin_conge->format('Y-m-d') }}" required>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="date_debut_periode" class="form-label">Date de Début de la Période Accordée <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" id="date_debut_periode" name="date_debut_periode" value="{{ $attestation->date_debut_periode->format('Y-m-d') }}" required>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="date_fin_periode" class="form-label">Date de Fin de la Période Accordée <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" id="date_fin_periode" name="date_fin_periode" value="{{ $attestation->date_fin_periode->format('Y-m-d') }}" required>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="annee" class="form-label">Année N <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" id="annee" name="annee" value="{{ $attestation->annee }}" min="2020" max="2030" required>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Statut de Validation</label>
                            <div class="form-control-plaintext">
                                @if($attestation->valide_directeur)
                                    <span class="badge bg-success">Validé le {{ $attestation->date_validation->format('d/m/Y') }}</span>
                                @else
                                    <span class="badge bg-warning">En attente de validation</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="d-flex justify-content-between">
                    <a href="{{ route('attestations_conge.show', $attestation->id) }}" class="btn btn-secondary">Retour</a>
                    <button type="submit" class="btn btn-success">Mettre à jour</button>
                </div>
            </form>
        </div>
    </div>
    
    <!-- Information sur la demande de congé associée -->
    <div class="card custom-card mt-4">
        <div class="card-header">
            <h5>Informations sur la Demande de Congé Associée</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <p><strong>Employé :</strong> {{ $attestation->demandeConge->user->nom }} {{ $attestation->demandeConge->user->prenom }}</p>
                    <p><strong>Matricule :</strong> {{ $attestation->demandeConge->user->matricule }}</p>
                    <p><strong>Fonction :</strong> {{ $attestation->demandeConge->user->fonction ?? 'Non spécifiée' }}</p>
                </div>
                <div class="col-md-6">
                    <p><strong>Période demandée :</strong> Du {{ $attestation->demandeConge->date_debut->format('d/m/Y') }} au {{ $attestation->demandeConge->date_fin->format('d/m/Y') }}</p>
                    <p><strong>Motif :</strong> {{ $attestation->demandeConge->motif }}</p>
                    <p><strong>Statut :</strong> 
                        @if($attestation->demandeConge->avis_superieur)
                            <span class="badge bg-success">Approuvé</span>
                        @else
                            <span class="badge bg-warning">En attente</span>
                        @endif
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .custom-card {
        border: 2px dashed #038C4F;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        transition: transform 0.2s, box-shadow 0.2s;
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

    .text-danger {
        color: #dc3545 !important;
    }
    
    .card-header {
        background-color: #f8f9fa;
        border-bottom: 1px solid #dee2e6;
    }
</style>
@endsection