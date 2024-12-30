@extends('layouts.app')

@section('title', 'Mes Documents')

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
            <!-- Zone de téléchargement -->
            <a href="{{ route('documents.create') }}" class="  mb-3">  <div class="mb-4">
        <div class="upload-box">
            <p><i class="bi bi-cloud-upload" style="font-size: 2rem; color: #038C4F;"></i></p>
<p>Ajouter un document
            </div>
    </div></a>
        <h2>Liste des Documents</h2>
        
        <!-- Message de succès -->
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif


        <table id="Table" class="table table-bordered ">
        <thead>
                <tr>
                    <th>Nom</th>
                    <th>Type de document</th>
                    <th>Type de partage</th>
                    <th>Statut</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($documents as $document)
                    <tr>
                        <td>{{ $document->nom }}</td>
                        <td>{{ $document->type_doc }}</td>
                        <td>{{ $document->type_share }}</td>
                        <td>{{ $document->status }}</td>
                        <td>
                            <a href="{{ route('documents.show', $document->id) }}" class="btn btn-info btn-sm">Voir</a>
                            <a href="{{ route('documents.edit', $document->id) }}" class="btn btn-warning btn-sm">Modifier</a>
                            <form action="{{ route('documents.destroy', $document->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce document ?')">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
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
                url: "//cdn.datatables.net/plug-ins/1.13.6/i18n/fr-FR.json"
            }
        });
    });
</script>
@endpush

