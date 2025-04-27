@extends('layouts.apprh')

@section('content')
<div class="container">    <div class="row">
<div class="col-md-9">
    <h1>Liste des Attestations de Travail</h1>   </div>
    <div  class="col-md-3">
    <a href="{{ route('attestations_travail.create') }}" class="btn btn-success">Créer une Attestation</a>
    </div>    </div>
    @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @elseif(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

    <div class="card custom-card">
        <div class="card-body">
            <table id="Table" class="table table-bordered table-striped">
                <thead class="table-success">
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Matricule</th>
                <th>Poste</th>
                <th>Lieu</th>
                <th>Validation</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($attestations as $attestation)
            <tr>
                <td>{{ $attestation->id }}</td>
                <td>{{ $attestation->user->nom }}</td>
                <td>{{ $attestation->user->matricule }}</td>
                <td>{{ $attestation->user->fonction }}</td>
                <td>{{ $attestation->lieu_travail }}</td>
                <td>
                    @if($attestation->date_validation)
                        <span class="text-success">Validée</span>
                    @else
                        <span class="text-danger">Non validée</span>
                    @endif
                </td>
                <td class="d-flex gap-2">
                    <a href="{{ route('attestations_travail.show', $attestation->id) }}" class="btn btn-info btn-sm">Voir</a>
                    <a href="{{ route('attestations_travail.edit', $attestation->id) }}" class="btn btn-warning btn-sm">Éditer</a>
                    @php
                        $permission = Auth::user()->permissionrh ?? null;
                        @endphp

    @if(in_array($permission, ['valideur']))
                    @if(!$attestation->date_validation)
                        <form action="{{ route('attestations_travail.validate', $attestation->id) }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-success btn-sm">Valider</button>
                        </form>
                        <form action="{{ route('attestations_travail.reject', $attestation->id) }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-danger btn-sm">Rejeter</button>
                        </form>
                    @endif
@endif
                    <form action="{{ route('attestations_travail.destroy', $attestation->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
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

