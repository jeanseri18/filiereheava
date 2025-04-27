@extends('layouts.app')

@section('title', 'Documents et Courriers')

@push('styles')
<style>
    .upload-box {
        border: 2px dashed #038C4F;
        border-radius: 8px;
        padding: 20px;
        text-align: center;
        background-color: #f8f9fa;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .upload-box:hover {
        background-color: #e9f7ef;
    }

    .upload-box p {
        margin: 0;
        font-size: 18px;
        color: #6c757d;
    }

    .upload-box input[type="file"] {
        display: none;
    }

    .table th, .table td {
        vertical-align: middle;
    }

    .badge-status {
        padding: 5px 10px;
        border-radius: 12px;
        font-size: 12px;
    }

    .badge-success {
        background-color: #28a745;
        color: white;
    }

    .badge-danger {
        background-color: #dc3545;
        color: white;
    }

    .badge-warning {
        background-color: #ffc107;
        color: black;
    }
</style>
@endpush

@section('content')
<div class="container">
    <!-- Zone de téléchargement pour les courriers -->
    <div class="mb-5">
        <h3 class="mb-4">Télécharger un Courrier</h3>
        <div class="upload-box" onclick="document.getElementById('courrier-upload').click();">
            <input type="file" id="courrier-upload" multiple>
            <p><i class="bi bi-envelope" style="font-size: 2rem; color: #038C4F;"></i></p>
            <p>Glissez vos courriers ici ou cliquez pour les sélectionner</p>
        </div>
    </div>

    <!-- Section Documents Entrants -->
    <div class="mb-5">
        <h3 class="mb-4">Documents Entrants</h3>
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Liste des Documents Entrants</h3>
            </div>
            <div class="card-body p-0">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nom du Document</th>
                            <th>Date d'Ajout</th>
                            <th>Statut</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Contrat_entrant_2023.pdf</td>
                            <td>2024-11-27</td>
                            <td><span class="badge badge-status badge-success">Validé</span></td>
                            <td>
                                <a href="#" class="btn btn-sm btn-primary"><i class="bi bi-eye"></i> Voir</a>
                                <a href="#" class="btn btn-sm btn-success"><i class="bi bi-download"></i> Télécharger</a>
                                <a href="#" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i> Supprimer</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Section Documents Sortants -->
    <div class="mb-5">
        <h3 class="mb-4">Documents Sortants</h3>
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Liste des Documents Sortants</h3>
            </div>
            <div class="card-body p-0">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nom du Document</th>
                            <th>Date d'Ajout</th>
                            <th>Statut</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Facture_sortante_2023.pdf</td>
                            <td>2024-11-27</td>
                            <td><span class="badge badge-status badge-warning">En attente</span></td>
                            <td>
                                <a href="#" class="btn btn-sm btn-primary"><i class="bi bi-eye"></i> Voir</a>
                                <a href="#" class="btn btn-sm btn-success"><i class="bi bi-download"></i> Télécharger</a>
                                <a href="#" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i> Supprimer</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Gestion de l'upload des fichiers
    document.getElementById('courrier-upload').addEventListener('change', function (e) {
        const files = e.target.files;
        console.log('Courriers sélectionnés :', files);
        alert(`${files.length} courrier(s) sélectionné(s).`);
    });
</script>
@endpush
