@extends('layouts.apprh')

@section('content')
<div class="container">
    <div class="row">
    <div class="col-md-9">
    <h1>Liste des demandes de congés</h1> </div>
    <div  class="col-md-3">

    @php
                        $permission = Auth::user()->permissionrh ?? null;
                        @endphp

    @if(in_array($permission, ['demandeur', 'superieur','valideur']))
    <a href="{{ route('demandes.create') }}" class="btn btn-success mb-3">Nouvelle demande</a>
    @endif
    </div>    </div>

        <a href="{{ route('demandes.create') }}" class="btn btn-success mb-3">Nouvelle demande</a>

<br>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <div class="card custom-card">
        <div class="card-body">
            <table id="Table" class="table table-bordered table-striped">
                <thead class="table-success">
            <tr>
                <th>Nom</th>
                <th>Matricule</th>
                <th>Fonction</th>
                <th>Date début</th>
                <th>Date fin</th>
                <th>Statut</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($demandes as $demande)
                <tr>
                    <td>{{ $demande->user->matricule }}</td>
                   <td> {{ $demande->user->nom }}</td>
                    <td>{{ $demande->user->fonction }}</td>
                    <td>{{ $demande->date_debut }}</td>
                    <td>{{ $demande->date_fin }}</td>
                    <td>
                    @if($demande->avis_superieur)
                        <span class="text-success">Validée</span>
                    @else
                        <span class="text-danger">Non validée</span>
                    @endif
                </td>
                    <td>
                        <!-- <a href="{{ route('demandes.show', $demande) }}" class="btn btn-info btn-sm">Voir</a> -->
                        <a href="{{ route('demandes.pdf', $demande) }}" class="btn btn-secondary btn-sm" target="_blank">voir</a>
                        <a href="{{ route('demandes.edit', $demande) }}" class="btn btn-warning btn-sm">Modifier</a>
                        @if(in_array($permission, ['rh', 'superieur','valideur']))
                        @if($demande->avis_superieur)
                    
                        <a href="{{ route('demandes.showvalidedoc', $demande) }}" class="btn btn-info btn-sm">    imprimer l'autorisation</a>

                        @else
                        <form action="{{ route('demandes.validate', $demande->id) }}" method="POST" style="display:inline;">
    @csrf
    <button type="submit" class="btn btn-success btn-sm">Valider</button>
</form>

<form action="{{ route('demandes.reject', $demande->id) }}" method="POST" style="display:inline;">
    @csrf
    <button type="submit" class="btn btn-danger btn-sm">Rejeter</button>
</form>
@endif
@endif
                        <form action="{{ route('demandes.destroy', $demande) }}" method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>


    </div>
</div>
</div>
<style>
    .custom-card {
        border: 2px dashed #038C4F; /* Bordure avec traits */
        border-radius: 8px; /* Coins arrondis */
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Légère ombre */
        transition: transform 0.2s, box-shadow 0.2s;
    }

    .custom-card:hover {
        transform: translateY(-5px); /* Animation au survol */
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2); /* Ombre plus marquée */
    }

    .table-bordered th, .table-bordered td {
        border: 1px dashed #ddd; /* Bordure en traits pour le tableau */
    }

    .btn-success {
        background-color: #038C4F;
        border-color: #038C4F;
    }

    .btn-success:hover {
        background-color: #026838;
        border-color: #026838;
    }
</style>
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

