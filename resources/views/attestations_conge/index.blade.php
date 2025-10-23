@extends('layouts.apprh')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-9">
            <h1>Liste des Attestations de Congé</h1>
        </div>
        <div class="col-md-3">
            @php
                $permission = Auth::user()->permissionrh ?? null;
            @endphp
            @if(in_array($permission, ['rh', 'valideur']))
                <a href="{{ route('attestations_conge.create') }}" class="btn btn-success">Créer une Attestation</a>
            @endif
        </div>
    </div>
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
                        <th>ID</th>
                        <th>Nom</th>
                        <th>Matricule</th>
                        <th>Période</th>
                        <th>Nombre de jours</th>
                        <th>Année</th>
                        <th>Validation Directeur</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($attestations as $attestation)
                    <tr>
                        <td>{{ $attestation->id }}</td>
                        <td>{{ $attestation->user->nom }} {{ $attestation->user->prenom }}</td>
                        <td>{{ $attestation->user->matricule }}</td>
                        <td>{{ $attestation->date_debut_periode->format('d/m/Y') }} au {{ $attestation->date_fin_periode->format('d/m/Y') }}</td>
                        <td>{{ $attestation->nombre_jours }}</td>
                        <td>{{ $attestation->annee }}</td>
                        <td>
                            @if($attestation->valide_directeur)
                                <span class="badge bg-success">Validé</span>
                            @else
                                <span class="badge bg-warning">En attente</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('attestations_conge.show', $attestation->id) }}" class="btn btn-info btn-sm">Voir</a>
                            
                            @php
                                $permission = Auth::user()->permissionrh ?? null;
                            @endphp
                            
                            @if(in_array($permission, ['rh', 'valideur']))
                                @if(!$attestation->valide_directeur)
                                    <form action="{{ route('attestations_conge.valider', $attestation->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-success btn-sm">Valider</button>
                                    </form>
                                    <form action="{{ route('attestations_conge.rejeter', $attestation->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-warning btn-sm">Rejeter</button>
                                    </form>
                                @endif
                                
                                <a href="{{ route('attestations_conge.edit', $attestation->id) }}" class="btn btn-primary btn-sm">Modifier</a>
                                
                                <form action="{{ route('attestations_conge.destroy', $attestation->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette attestation ?')">Supprimer</button>
                                </form>
                            @endif
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
        border: 2px dashed #038C4F;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        transition: transform 0.2s, box-shadow 0.2s;
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
</style>
@endsection

@push('styles')
<link href="https://cdn.datatables.net/v/bs5/jq-3.7.0/jszip-3.10.1/dt-2.1.8/b-3.2.0/b-colvis-3.2.0/b-html5-3.2.0/b-print-3.2.0/r-3.0.3/datatables.min.css" rel="stylesheet">
@endpush

@push('scripts')
<script src="https://cdn.datatables.net/v/bs5/jq-3.7.0/jszip-3.10.1/dt-2.1.8/b-3.2.0/b-colvis-3.2.0/b-html5-3.2.0/b-print-3.2.0/r-3.0.3/datatables.min.js"></script>
<script>
    $(document).ready(function() {
        $('#Table').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ],
            language: {
                url: 'https://cdn.datatables.net/plug-ins/1.11.5/i18n/fr-FR.json'
            }
        });
    });
</script>
@endpush