@extends('layouts.app')

@section('title', 'Dashboard')

@push('styles')
<style>
    /* Supprimer les soulignements des liens */
a {
    text-decoration: none;
}

/* Uniformiser la hauteur des cartes */
.dashboard-block {
    height: 100%; /* Assure que toutes les cartes ont une hauteur égale */
    display: flex;
    flex-direction: column;    align-items: left;

    justify-content: space-between;
}

.dashboard-block {
    background-color: #f8f9fa;
    border: 1px solid #ddd;
    border-radius: 8px;
    padding: 20px;
    display: flex;
    align-items: left;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}
.dashboard-block i {
    font-size: 2.5rem;
    color: black;
    margin-right: 15px;
}

.dashboard-block h3, .dashboard-block h6 {
    margin-bottom: 0;
}

.dashboard-block p {
    font-size: 1rem;
    color: #6c757d;
    margin-top: 5px;
}

.quick-action-block {
    background-color: #038C4F;
    color: white;
    border-radius: 8px;
    padding: 20px;
}

.quick-action-block .dashboard-block {
    background-color: white;
    border: none;
    box-shadow: none;
    color: black;
}

.quick-action-block h6 {
    color: black;
    font-weight:bold;
}

.quick-action-block p {
    font-size: 0.9rem;
    color: #5E8868FF;
    margin-top: 5px;
}

.statistics-section .dashboard-block {
    background-color: #FAFBFCFF;
    border: 1px solid #ddd;
    border-radius: 8px;
    padding: 20px;
    display: flex;
    align-items: left;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}
.statistics-section .dashboard-block i {
    font-size: 2.5rem;
    margin-right: 15px;
    color: #5a5c69;
}
.statistics-section .dashboard-block h6 {
    font-size: 1.2rem;
    color: #343a40;
}
.statistics-section .dashboard-block p {
    font-size: 1rem;
    color: #6c757d;
}
</style>
@endpush

@section('content')
<div class="container">
    <h1 class="text-left mb-4">Tableau de Bord</h1>

    <!-- Section des statistiques -->
    <div class="statistics-section mb-5">
        <h4 class="text-left mb-4">Statistiques</h4>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="dashboard-block">
                    <i class="bi bi-files"></i>
                    <div>
                        <h6>Total des documents</h6>
                        <p>{{ $totalDocuments }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="dashboard-block">
                    <i class="bi bi-check-circle"></i>
                    <div>
                        <h6>Documents validés</h6>
                        <p>{{ $validatedDocuments }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="dashboard-block">
                    <i class="bi bi-clock-history"></i>
                    <div>
                        <h6>Documents en attente</h6>
                        <p>{{ $pendingDocuments }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="dashboard-block">
                    <i class="bi bi-x-circle"></i>
                    <div>
                        <h6>Documents rejetés</h6>
                        <p>{{ $rejectedDocuments }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="dashboard-block">
                    <i class="bi bi-archive"></i>
                    <div>
                        <h6>Documents archivés</h6>
                        <p>{{ $archivedDocuments }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <!-- Actions rapides -->
    <div class="quick-action-block mt-5">
        <h4 class="text-left mb-4">Actions rapides</h4>
        <div class="row g-4">
            
            <div class="col-md-3">
                <div class="dashboard-block">
                <a href="{{ route('documents.create')  }}">
                    <i class="bi bi-upload"></i>
                    <div>
                        <h6>Ajouter un document</h6>
                        <p>Envoyez un document pour validation.</p>
                    </div>
                    </a>
                </div>
            </div>
            <div class="col-md-3">
                <div class="dashboard-block">
                <a href="{{ route('documents.pending') }}" >

                    <i class="bi bi-check2-square"></i>
                    <div>
                        <h6>Valider un document</h6>
                        <p>Accédez à la liste des documents en attente de votre validation</p>
                    </div></a>
                </div>
            </div>
            <div class="col-md-3">
                <div class="dashboard-block">
                <a href="{{ route('archives.index') }}" >

                    <i class="bi bi-archive"></i>
                    <div>
                        <h6>Archivage</h6>
                        <p>Organisez et stockez vos documents ajoutés archivés.</p>
                    </div>
                    </a>
                </div>
            </div>
            <div class="col-md-3">
                <div class="dashboard-block">
                <a href="{{ route('archives.index') }}" >

                    <i class="bi bi-search"></i>
                    <div>
                        <h6>Recherche</h6>
                        <p>Recherchez un document spécifique dans votre espace.</p>
                    </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
<br><br>
    <!-- Dernières actions -->
    <div class="card mb-4">
    <div class="card-header">
        <h3 class="card-title">Dernières Actions</h3>
    </div>
    <div class="card-body p-0">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th style="width: 10px">#</th>
                    <th>Action</th>
                    <th>Utilisateur</th>
                    <th>Document</th>
                    <th>Date</th>
                    <th>Statut</th>
                </tr>
            </thead>
            <tbody>
                @foreach($recentActions as $key => $action)
                <tr class="align-middle">
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $action->action }}</td>
                    <td>{{ $action->user->name }}</td>
                    <td>{{ $action->document->title }}</td>
                    <td>{{ $action->action_date->format('Y-m-d H:i:s') }}</td>
                    <td>
                        <span class="badge text-bg-{{ $action->status_class }}">
                            {{ ucfirst($action->status) }}
                        </span>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

</div>
@endsection

@push('scripts')
{{-- Ajouter des scripts spécifiques à cette page --}}
@endpush
