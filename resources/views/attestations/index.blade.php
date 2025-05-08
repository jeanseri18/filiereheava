@extends('layouts.apprh')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-md-9">
            <h1 class="text-2xl font-bold">Mes Attestations </h1>
        </div>
        <div class="col-md-3 text-end">
        @php
                        $permission = Auth::user()->permissionrh ?? null;
                        @endphp

                        @if(in_array($permission, ['rh', 'valideur']))
            <a href="{{ route('attestations.create') }}" class="btn btn-success">Nouvelle Attestation</a>
            @endif
        </div>
    </div>

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
            <div class="table-responsive">
                <table id="Table" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Poste</th>
                            <th>Service</th>
                            <th>Date de reprise</th>
                            <th>Lieu</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($attestations as $attestation)
                            <tr>
                                <td>{{ $attestation->nom }}</td>
                                <td>{{ $attestation->poste }}</td>
                                <td>{{ $attestation->service }}</td>
                                <td>{{ \Carbon\Carbon::parse($attestation->date_reprise)->format('d/m/Y') }}</td>
                                <td>{{ $attestation->lieu }}</td>
                                <td class="text-center">
                                    <a href="{{ route('attestations.show', $attestation) }}" class="btn btn-info btn-sm mb-1">Voir</a>

                                    <form action="{{ route('attestations.destroy', $attestation) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Tu es sûr de vouloir supprimer ?')">Supprimer</button>
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
            border: 2px dashed #038C4F;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .custom-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
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
