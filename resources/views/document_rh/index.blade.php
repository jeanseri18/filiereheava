@extends('layouts.apprh')

@section('content')
<div class="container">
    <h2>Liste des Documents RH</h2>
    <a href="{{ route('document_rh.create') }}" class="btn btn-success mb-3">Ajouter un Document</a>

    <div class="card custom-card">
        <div class="card-body">
            <table id="Table" class="table table-bordered table-striped">
                <thead class="table-success">
                    
            <tr>
                <th>Nom du Document</th>
        
                <th>Utilisateur</th>
                <th>Catégorie</th>
                <th>Sous-Catégorie</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($documents as $document)
            <tr>
                <td>{{ $document->nom_document }}</td>
      
                <td>{{ $document->user->nom }}</td>
                <td>{{ $document->famille }}</td>
                <td>{{ $document->sous_famille }}</td>
                <td>

                @php
    $extension = pathinfo('storage/'.$document->file_url, PATHINFO_EXTENSION);
@endphp

@if(in_array($extension, ['jpg', 'jpeg', 'png', 'gif']))
    <a href="{{ asset('storage/'.$document->file_url) }}" target="_blank">
        <button class="btn btn-primary btn-sm">Voir l’image</button>
    </a>
@elseif($extension == 'pdf')
    <a href="{{ asset('storage/'.$document->file_url) }}" target="_blank">
        
        <button class="btn btn-danger btn-sm">Voir le PDF</button>
    </a>
@else
    <a href="{{ asset('storage/'.$document->file_url) }}" download>
        <button class="btn btn-success btn-sm">Télécharger</button>
    </a>
@endif

                    <a href="{{ route('document_rh.edit', $document->id) }}" class="btn btn-warning">Modifier</a>
                    <form action="{{ route('document_rh.destroy', $document->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Supprimer</button>
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
    /* Bordure avec traits */
    border-radius: 8px;
    /* Coins arrondis */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    /* Légère ombre */
    transition: transform 0.2s, box-shadow 0.2s;
}

.custom-card:hover {
    transform: translateY(-5px);
    /* Animation au survol */
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
    /* Ombre plus marquée */
}

.table-bordered th,
.table-bordered td {
    border: 1px dashed #ddd;
    /* Bordure en traits pour le tableau */
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
<link
    href="https://cdn.datatables.net/v/bs5/jq-3.7.0/jszip-3.10.1/dt-2.1.8/b-3.2.0/b-colvis-3.2.0/b-html5-3.2.0/b-print-3.2.0/r-3.0.3/datatables.min.css"
    rel="stylesheet">
@endpush

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
<script
    src="https://cdn.datatables.net/v/bs5/jq-3.7.0/jszip-3.10.1/dt-2.1.8/b-3.2.0/b-colvis-3.2.0/b-html5-3.2.0/b-print-3.2.0/r-3.0.3/datatables.min.js">
</script>
<script>
$(document).ready(function() {
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