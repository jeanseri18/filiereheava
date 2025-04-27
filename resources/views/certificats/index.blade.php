@extends('layouts.apprh')

@section('content')
<div class="container">
    <div class="row">
    <div class="col-md-9">
        <h1>Liste des Certificats de Travail</h1>
        </div>
        <div  class="col-md-3">
        <a href="{{ route('certificats.create') }}" class="btn btn-success mb-3">Créer un nouveau certificat</a>
        </div>    </div>
<br>

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
                    <th>Utilisateur</th>
                    <th>Numéro CNPS</th>
                    <th>Date de début</th>
                    <th>Date de fin</th>
                    <th>Type de contrat</th>
                    <th>Poste</th>
                    <th>Validation Directeur</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($certificats as $certificat)
                    <tr>
                        <td>{{ $certificat->user->nom }}</td>
                        <td>{{ $certificat->numero_cnps }}</td>
                        <td>{{ $certificat->date_debut->format('d/m/Y') }}</td>
                        <td>{{ $certificat->date_fin->format('d/m/Y') }}</td>
                        <td>{{ $certificat->type_contrat }}</td>
                        <td>{{ $certificat->user->fonction }}</td>
                        <td>
                            @if($certificat->validation_directeur)
                                <span class="text-success">Validé</span>
                            @else
                                <span class="text-danger">Non validé</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('certificats.show', $certificat->id) }}" class="btn btn-info btn-sm">Afficher</a>
                            <a href="{{ route('certificats.edit', $certificat->id) }}" class="btn btn-warning btn-sm">Modifier</a>
                            @php
                        $permission = Auth::user()->permissionrh ?? null;
                        @endphp

    @if(in_array($permission, ['valideur']))
                            @if(!$certificat->validation_directeur)
                                <form action="{{ route('certificats.valider', $certificat->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-success btn-sm">Valider</button>
                                </form>
                          
                                <form action="{{ route('certificats.rejeter', $certificat->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-sm">Rejeter</button>
                                </form>
                            @endif
@endif
                            <form action="{{ route('certificats.destroy', $certificat->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce certificat ?')">Supprimer</button>
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


