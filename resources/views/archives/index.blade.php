@extends('layouts.app')

@section('content')
<div class="container">
<div class="alert alert-success">
        <h1>Archivage</h1>
        <p>Gestion des documents</p>
    </div>

    <!-- Formulaire de recherche -->
    <form method="GET" action="{{ route('archives.index') }}" class="mb-4">
        <div class="row g-3">
            <div class="col-md-3">
                <input type="text" name="nom" class="form-control" placeholder="Nom du document" value="{{ request('nom') }}">
            </div>
            <!--div class="col-md-3">
                <select name="type_doc" class="form-select">
                    <option value="">-- Type de document --</option>
                    @foreach($typesDoc as $type)
                        <option value="{{ $type }}" {{ request('type_doc') == $type ? 'selected' : '' }}>
                            {{ ucfirst($type) }}
                        </option>
                    @endforeach
                </select>
            </div-->
            <div class="col-md-3">
                <select name="type_share" class="form-select">
                    <option value="">-- Type de partage --</option>
                    @foreach($typesShare as $share)
                        <option value="{{ $share }}" {{ request('type_share') == $share ? 'selected' : '' }}>
                            {{ ucfirst($share) }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <select name="status" class="form-select">
                    <option value="">-- Statut --</option>
                    @foreach($statuses as $status)
                        <option value="{{ $status }}" {{ request('status') == $status ? 'selected' : '' }}>
                            {{ ucfirst($status) }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="row g-3 mt-3">
            <div class="col-md-12 text-start">
                <button type="submit" class="btn btn-success">Rechercher</button>
                <a href="{{ route('archives.index') }}" class="btn btn-secondary">Réinitialiser</a>
            </div>
        </div>
    </form>
    <div class="card custom-card">
    <div class="card-body">
    <!-- Table des résultats -->
    @if($documents->count())

        <table id ="Table" class="table table-striped">
        <thead class="table-success">
        <tr>
                    <th>#</th>
                    <th>Nom</th>
                    <th>Type</th>
                    <th>Partage</th>
                    <th>Statut</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($documents as $document)
                    <tr>
                        <td>{{ $document->id }}</td>
                        <td>{{ $document->nom }}</td>
                        <td>{{ $document->type_doc }}</td>
                        <td>{{ $document->type_share }}</td>
                        <td>   <span class="badge-status @if($document->status == 'validé') badge-success
                                @elseif($document->status == 'rejeté') badge-danger
                                @elseif($document->status == 'ajouté') badge-warning
                                @elseif($document->status == 'soumis') badge-info
                                @else badge-secondary @endif">{{ $document->status }}</span></span></td>
                        <td>
                            <a href="{{ asset('storage/' . $document->file_url) }}" class="btn btn-success btn-sm" target="blank">Télécharger</a>
                            @if($document->status === 'archivé')
    <form method="POST" action="{{ route('archives.unarchive', $document) }}" style="display:inline;">
        @csrf
        <button type="submit" class="btn btn-warning btn-sm">Désarchiver</button>
    </form>
@else
    <form method="POST" action="{{ route('archives.archive', $document) }}" style="display:inline;">
        @csrf
        <button type="submit" class="btn btn-danger btn-sm">Archiver</button>
    </form>
@endif

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    @else
        <p>Aucun document trouvé avec ces critères.</p>
    @endif
</div>
</div>
</div>

<!-- Styles personnalisés -->
<style>
    .badge-status {
        padding: 5px 10px;
        border-radius: 12px;
        font-size: 12px;
    }

    .badge-success {
        background-color: #28a745;
        color: white;
    }
    .badge-black {
        background-color: black;
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

    .badge-info {
        background-color: #17a2b8;
        color: white;
    }

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

