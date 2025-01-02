@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="my-4">Liste des documents archivés</h1>

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
                <button type="submit" class="btn btn-primary">Rechercher</button>
                <a href="{{ route('archives.index') }}" class="btn btn-secondary">Réinitialiser</a>
            </div>
        </div>
    </form>

    <!-- Table des résultats -->
    @if($documents->count())
        <table id ="Table" class="table table-striped">
            <thead>
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
                        <td><span class="badge bg-info">{{ ucfirst($document->status) }}</span></td>
                        <td>
                            <a href="{{ route('archives.download', $document) }}" class="btn btn-success btn-sm">Télécharger</a>
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

