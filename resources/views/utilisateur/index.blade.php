@extends('layouts.app')

@section('title', 'Liste des Utilisateurs')

@section('content')
<div class="container">
    <h1 class="my-4">Liste des Utilisateurs</h1>

    {{-- Tableau des utilisateurs --}}
            <h5 class="mb-0">Tous les utilisateurs</h5>
            <br><br>
            <table id="Table" class="table table-bordered table-striped table-hover">
                <thead class="bg-secondary text-white">
                    <tr>
                        <th>#</th>
                        <th>Nom et Prénom</th>
                        <th>Email</th>
                        <th>Rôle</th>
                        <th>Service</th>
                        <th>Direction</th>
                        <th>Date de Création</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- Données statiques --}}
                    <tr>
                        <td>1</td>
                        <td>Jean Dupont</td>
                        <td>jean.dupont@example.com</td>
                        <td><span class="badge bg-info">Utilisateur</span></td>
                        <td>Informatique</td>
                        <td>Technologies</td>
                        <td>01/01/2023</td>
                        <td>
                            <div class="d-flex justify-content-center">
                                {{-- Bouton Modifier --}}
                                <a href="#" class="btn btn-sm btn-warning me-2">
                                    <i class="fa fa-edit"></i> Modifier
                                </a>

                                {{-- Bouton Supprimer --}}
                                <button type="button" class="btn btn-sm btn-danger" onclick="confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?')">
                                    <i class="fa fa-trash"></i> Supprimer
                                </button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Marie Curie</td>
                        <td>marie.curie@example.com</td>
                        <td><span class="badge bg-danger">Administrateur</span></td>
                        <td>Recherche</td>
                        <td>Sciences</td>
                        <td>15/02/2023</td>
                        <td>
                            <div class="d-flex justify-content-center">
                                <a href="#" class="btn btn-sm btn-warning me-2">
                                    <i class="fa fa-edit"></i> Modifier
                                </a>
                                <button type="button" class="btn btn-sm btn-danger" onclick="confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?')">
                                    <i class="fa fa-trash"></i> Supprimer
                                </button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Albert Einstein</td>
                        <td>albert.einstein@example.com</td>
                        <td><span class="badge bg-info">Utilisateur</span></td>
                        <td>Physique</td>
                        <td>Sciences</td>
                        <td>20/03/2023</td>
                        <td>
                            <div class="d-flex justify-content-center">
                                <a href="#" class="btn btn-sm btn-warning me-2">
                                    <i class="fa fa-edit"></i> Modifier
                                </a>
                                <button type="button" class="btn btn-sm btn-danger" onclick="confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?')">
                                    <i class="fa fa-trash"></i> Supprimer
                                </button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
      
</div>
@endsection

@push('styles')
<link href="https://cdn.datatables.net/v/bs5/jq-3.7.0/jszip-3.10.1/dt-2.1.8/b-3.2.0/b-colvis-3.2.0/b-html5-3.2.0/b-print-3.2.0/r-3.0.3/datatables.min.css" rel="stylesheet">
@endpush

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/v/bs5/jq-3.7.0/jszip-3.10.1/dt-2.1.8/b-3.2.0/b-colvis-3.2.0/b-html5-3.2.0/b-print-3.2.0/r-3.0.3/datatables.min.js"></script>
<script>
    $(document).ready(function () {
        $('#Table').DataTable({
            responsive: true,
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print', 'colvis'
            ],
            language: {
                url: "https://cdn.datatables.net/plug-ins/1.13.6/i18n/fr-FR.json"

            }
        });
    });
</script>
@endpush

