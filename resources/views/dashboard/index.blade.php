@extends('layouts.app')

@section('title', 'Dashboard')

@push('styles')
<style>
.dashboard-block {
    background-color: #f8f9fa;
    border: 1px solid #ddd;
    border-radius: 8px;
    padding: 20px;
    display: flex;
    align-items: center;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}
.{height:200dashheight px;}

.dashboard-block i {
    font-size: 2.5rem;
    color: black;
    margin-right: 15px;
}

.dashboard-block h3 {
    font-size: 1.5rem;
    margin-bottom: 0;
}

.dashboard-block h6 {
    color: black;
    font-size: 1rem;
    margin-bottom: 0;
}

.dashboard-block p {
    font-size: 1rem;
    color: #6c757d;
    margin-top: 5px;
    margin-bottom: 0;
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
</style>
@endpush

@section('content')
<div class="container">
    <h1 class="text-left mb-4">Tableau de Bord</h1>
    <div class="row g-4">
        <!-- Bloc Document partagé -->
        <div class="col-md-4">
            <div class="dashboard-block">
                <i class="bi bi-share"></i>
                <div>
                    <h3>Document partagé</h3>
                    <p>Vos documents partagés avec d'autres utilisateurs.</p>
                </div>
            </div>
        </div>
        <!-- Bloc Document en attente -->
        <div class="col-md-4">
            <div class="dashboard-block">
                <i class="bi bi-clock-history"></i>
                <div>
                    <h3>Document en attente</h3>
                    <p>Documents en attente de validation par les responsables.</p>
                </div>
            </div>
        </div>
        <!-- Bloc Document validé -->
        <div class="col-md-4">
            <div class="dashboard-block">
                <i class="bi bi-check-circle"></i>
                <div>
                    <h3>Document validé</h3>
                    <p>Documents validés et prêts à être utilisés.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="quick-action-block mt-5">
        <h4 class="text-left mb-4">Actions rapides</h4>
        <div class="row g-4">
            <!-- Soumettre un document -->
            <div class="col-md-3 ">
                <div class="dashheight dashboard-block">
                    <i class="bi bi-upload"></i>
                    <div>
                        <h6>Ajouter un document</h6>
                        <p>Envoyez un document pour validation.</p>
                    </div>
                </div>
            </div>
            <!-- Valider un document -->
            <div class="col-md-3 ">
                <div class="dashheight dashboard-block">
                    <i class="bi bi-check2-square"></i>
                    <div>
                        <h6>Valider un document</h6>
                        <p>Accédez à la liste des documents en attente de votre validation </p>
                    </div>
                </div>
            </div>
            <!-- Archivage -->
            <div class="col-md-3 ">
                <div class="dashheight dashboard-block">
                    <i class="bi bi-archive"></i>
                    <div>
                        <h6>Archivage</h6>
                        <p>Organisez et stockez vos documents ajouté archivés.</p>
                    </div>
                </div>
            </div>
            <!-- Recherche -->
            <div class="col-md-3 ">
                <div class="dashheight dashboard-block">
                    <i class="bi bi-search"></i>
                    <div>
                        <h6>Recherche</h6>
                        <p>Recherchez un document spécifique dans votre espace.</p>
                    </div>
                </div>
            </div>
        </div>
    </div><br><br>
    <div class="card mb-4">
    <div class="card-header">
        <h3 class="card-title">Dernières Actions</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body p-0">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th style="width: 10px">#</th>
                    <th>Action</th>
                    <th>Date</th>
                    <th>Statut</th>
                </tr>
            </thead>
            <tbody>
                <tr class="align-middle">
                    <td>1.</td>
                    <td>Soumission de document</td>
                    <td>2024-11-27</td>
                    <td><span class="badge text-bg-success">Terminé</span></td>
                </tr>
                <tr class="align-middle">
                    <td>2.</td>
                    <td>Validation en attente</td>
                    <td>2024-11-26</td>
                    <td><span class="badge text-bg-warning">En cours</span></td>
                </tr>
                <tr class="align-middle">
                    <td>3.</td>
                    <td>Archivage complété</td>
                    <td>2024-11-25</td>
                    <td><span class="badge text-bg-primary">Complété</span></td>
                </tr>
                <tr class="align-middle">
                    <td>4.</td>
                    <td>Recherche d'un document</td>
                    <td>2024-11-24</td>
                    <td><span class="badge text-bg-danger">Erreur</span></td>
                </tr>
            </tbody>
        </table>
    </div>
    <!-- /.card-body -->
</div>
<!-- /.card -->
</div>

@endsection

@push('scripts')
{{-- Ajouter des scripts spécifiques à cette page --}}
@endpush
