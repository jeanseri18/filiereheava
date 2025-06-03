@extends('layouts.apprh')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-md-8">
            <h1>Fiche Employé</h1>
        </div>
        <div class="col-md-4 text-end">
            <a href="{{ route('personnel.index') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Retour
            </a>
            <a href="{{ route('personnel.edit', $user->id) }}" class="btn btn-warning">
                <i class="bi bi-pencil"></i> Modifier
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="row">
        <!-- Informations personnelles -->
        <div class="col-md-4 mb-4">
            <div class="card custom-card">
                <div class="card-header bg-success text-white">
                    <h5 class="card-title mb-0">Informations Personnelles</h5>
                </div>
                <div class="card-body">
                    <div class="text-center mb-3">
                        @if($user->file_url)
                            <img src="{{ asset($user->file_url) }}" alt="Photo" class="rounded-circle img-thumbnail" style="width: 150px; height: 150px;">
                        @else
                            <div class="bg-light rounded-circle mx-auto d-flex align-items-center justify-content-center" style="width: 150px; height: 150px;">
                                <i class="bi bi-person-circle" style="font-size: 5rem;"></i>
                            </div>
                        @endif
                    </div>
                    
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <th>Matricule:</th>
                                    <td>{{ $user->matricule }}</td>
                                </tr>
                                <tr>
                                    <th>Nom:</th>
                                    <td>{{ $user->nom }}</td>
                                </tr>
                                <tr>
                                    <th>Email:</th>
                                    <td>{{ $user->email }}</td>
                                </tr>
                                <tr>
                                    <th>Fonction:</th>
                                    <td>{{ $user->fonction }}</td>
                                </tr>
                                <tr>
                                    <th>Service:</th>
                                    <td>{{ $user->service->nom_service ?? 'Non défini' }}</td>
                                </tr>
                                <tr>
                                    <th>N° CNPS:</th>
                                    <td>{{ $user->numcnps ?? 'Non renseigné' }}</td>
                                </tr>
                                <tr>
                                    <th>Rôle:</th>
                                    <td>{{ $user->role }}</td>
                                </tr>
                                <tr>
                                    <th>Permission RH:</th>
                                    <td>{{ $user->permissionrh }}</td>
                                </tr>
                                <tr>
                                    <th>Statut:</th>
                                    <td>
                                        @if($user->status == 'actif')
                                            <span class="badge bg-success">Actif</span>
                                        @else
                                            <span class="badge bg-danger">Inactif</span>
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Documents RH -->
        <div class="col-md-8 mb-4">
            <div class="card custom-card">
                <div class="card-header bg-success text-white">
                    <h5 class="card-title mb-0">Documents</h5>
                </div>
                <div class="card-body">
                    @if($documents->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead class="bg-light">
                                    <tr>
                                        <th>Nom du document</th>
                                        <th>Catégorie</th>
                                        <th>Sous-catégorie</th>
                                        <th>Date d'ajout</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($documents as $document)
                                        <tr>
                                            <td>{{ $document->nom_document }}</td>
                                            <td>{{ $document->categorie->nom_categorie ?? 'Non défini' }}</td>
                                            <td>{{ $document->sousCategorie->nom_sous_categorie ?? 'Non défini' }}</td>
                                            <td>{{ $document->created_at->format('d/m/Y') }}</td>
                                            <td>
                                                @if($document->file_url)
                                                    <a href="{{ asset($document->file_url) }}" class="btn btn-sm btn-info" target="_blank">
                                                        <i class="bi bi-eye"></i> Voir
                                                    </a>
                                                    <a href="{{ asset($document->file_url) }}" class="btn btn-sm btn-primary" download>
                                                        <i class="bi bi-download"></i> Télécharger
                                                    </a>
                                                @else
                                                    <span class="text-muted">Aucun fichier</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="alert alert-info">
                            Aucun document n'est disponible pour cet employé.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Onglets pour les différentes demandes -->
    <div class="row">
        <div class="col-12">
            <div class="card custom-card">
                <div class="card-header bg-success text-white">
                    <h5 class="card-title mb-0">Historique des demandes</h5>
                </div>
                <div class="card-body">
                    <ul class="nav nav-tabs" id="historyTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="absences-tab" data-bs-toggle="tab" data-bs-target="#absences" type="button" role="tab" aria-controls="absences" aria-selected="true">
                                Demandes d'absence
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="conges-tab" data-bs-toggle="tab" data-bs-target="#conges" type="button" role="tab" aria-controls="conges" aria-selected="false">
                                Demandes de congés
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="attestations-tab" data-bs-toggle="tab" data-bs-target="#attestations" type="button" role="tab" aria-controls="attestations" aria-selected="false">
                                Attestations
                            </button>
                        </li>
                    </ul>
                    
                    <div class="tab-content pt-3" id="historyTabsContent">
                        <!-- Demandes d'absence -->
                        <div class="tab-pane fade show active" id="absences" role="tabpanel" aria-labelledby="absences-tab">
                            @if($user->demandesAbsences->count() > 0)
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped">
                                        <thead class="bg-light">
                                            <tr>
                                                <th>Date de demande</th>
                                                <th>Objet</th>
                                                <th>Du</th>
                                                <th>Au</th>
                                                <th>Nombre de jours</th>
                                                <th>Statut</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($user->demandesAbsences as $demande)
                                                <tr>
                                                    <td>{{ \Carbon\Carbon::parse($demande->date_creation)->format('d/m/Y') }}</td>
                                                    <td>{{ $demande->objet_demande }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($demande->date_debut)->format('d/m/Y') }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($demande->date_fin)->format('d/m/Y') }}</td>
                                                    <td>{{ $demande->nombre_jours }}</td>
                                                    <td>
                                                        @if($demande->validation_superieur)
                                                            <span class="badge bg-success">Validée</span>
                                                        @else
                                                            <span class="badge bg-danger">Non validée</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('demandes_absence.show', $demande->id) }}" class="btn btn-sm btn-info">
                                                            <i class="bi bi-eye"></i> Voir
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <div class="alert alert-info">
                                    Aucune demande d'absence pour cet employé.
                                </div>
                            @endif
                        </div>
                        
                        <!-- Demandes de congés -->
                        <div class="tab-pane fade" id="conges" role="tabpanel" aria-labelledby="conges-tab">
                            @if($user->demandesDepartConges->count() > 0)
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped">
                                        <thead class="bg-light">
                                            <tr>
                                                <th>Service/Secteur</th>
                                                <th>Motif</th>
                                                <th>Du</th>
                                                <th>Au</th>
                                                <th>Jours ouvrables</th>
                                                <th>Statut</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($user->demandesDepartConges as $demande)
                                                <tr>
                                                    <td>{{ $demande->service_secteur }}</td>
                                                    <td>{{ $demande->motif }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($demande->date_debut)->format('d/m/Y') }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($demande->date_fin)->format('d/m/Y') }}</td>
                                                    <td>{{ $demande->nombre_jours_ouvrables }}</td>
                                                    <td>
                                                        @if($demande->avis_superieur)
                                                            <span class="badge bg-success">Validée</span>
                                                        @else
                                                            <span class="badge bg-danger">Non validée</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('demandes.show', $demande->id) }}" class="btn btn-sm btn-info">
                                                            <i class="bi bi-eye"></i> Voir
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <div class="alert alert-info">
                                    Aucune demande de congé pour cet employé.
                                </div>
                            @endif
                        </div>
                        
                        <!-- Attestations -->
                        <div class="tab-pane fade" id="attestations" role="tabpanel" aria-labelledby="attestations-tab">
                            <ul class="nav nav-pills mb-3" id="attestationsPills" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="travail-tab" data-bs-toggle="pill" data-bs-target="#travail" type="button" role="tab" aria-controls="travail" aria-selected="true">
                                        Attestations de travail
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="stage-tab" data-bs-toggle="pill" data-bs-target="#stage" type="button" role="tab" aria-controls="stage" aria-selected="false">
                                        Attestations de stage
                                    </button>
                                </li>
                            </ul>
                            
                            <div class="tab-content" id="attestationsPillsContent">
                                <!-- Attestations de travail -->
                                <div class="tab-pane fade show active" id="travail" role="tabpanel" aria-labelledby="travail-tab">
                                    @if($user->attestationsTravail->count() > 0)
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-striped">
                                                <thead class="bg-light">
                                                    <tr>
                                                        <th>Date de création</th>
                                                        <th>Type de contrat</th>
                                                        <th>Lieu de travail</th>
                                                        <th>Date d'embauche</th>
                                                        <th>Statut</th>
                                                        <th>Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($user->attestationsTravail as $attestation)
                                                        <tr>
                                                            <td>{{ $attestation->created_at->format('d/m/Y') }}</td>
                                                            <td>{{ $attestation->type_contrat }}</td>
                                                            <td>{{ $attestation->lieu_travail }}</td>
                                                            <td>{{ $attestation->date_embauche->format('d/m/Y') }}</td>
                                                            <td>
                                                                @if($attestation->validation_directeur)
                                                                    <span class="badge bg-success">Validée</span>
                                                                @else
                                                                    <span class="badge bg-danger">Non validée</span>
                                                                @endif
                                                            </td>
                                                            <td>
                                                                <a href="{{ route('attestations_travail.show', $attestation->id) }}" class="btn btn-sm btn-info">
                                                                    <i class="bi bi-eye"></i> Voir
                                                                </a>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    @else
                                        <div class="alert alert-info">
                                            Aucune attestation de travail pour cet employé.
                                        </div>
                                    @endif
                                </div>
                                
                                <!-- Attestations de stage -->
                                <div class="tab-pane fade" id="stage" role="tabpanel" aria-labelledby="stage-tab">
                                    @if($user->AttestationStages->count() > 0)
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-striped">
                                                <thead class="bg-light">
                                                    <tr>
                                                        <th>Date de création</th>
                                                        <th>Secteur</th>
                                                        <th>Durée</th>
                                                        <th>Date début</th>
                                                        <th>Date fin</th>
                                                        <th>Statut</th>
                                                        <th>Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($user->AttestationStages as $attestation)
                                                        <tr>
                                                            <td>{{ $attestation->created_at->format('d/m/Y') }}</td>
                                                            <td>{{ $attestation->secteur }}</td>
                                                            <td>{{ $attestation->duree_stage }} mois</td>
                                                            <td>{{ \Carbon\Carbon::parse($attestation->date_debut)->format('d/m/Y') }}</td>
                                                            <td>{{ \Carbon\Carbon::parse($attestation->date_fin)->format('d/m/Y') }}</td>
                                                            <td>
                                                                @if($attestation->validation_directeur)
                                                                    <span class="badge bg-success">Validée</span>
                                                                @else
                                                                    <span class="badge bg-danger">Non validée</span>
                                                                @endif
                                                            </td>
                                                            <td>
                                                                <a href="{{ route('attestations_stage.show', $attestation->id) }}" class="btn btn-sm btn-info">
                                                                    <i class="bi bi-eye"></i> Voir
                                                                </a>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    @else
                                        <div class="alert alert-info">
                                            Aucune attestation de stage pour cet employé.
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
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
        margin-bottom: 20px;
    }

    .custom-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
    }

    .table-bordered th, .table-bordered td {
        border: 1px dashed #ddd;
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
    
    .nav-tabs .nav-link.active {
        color: #038C4F;
        font-weight: bold;
    }
    
    .nav-pills .nav-link.active {
        background-color: #038C4F;
    }
</style>
@endsection