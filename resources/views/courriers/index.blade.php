@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
    <div class="col-md-9">
    <h1>Liste des Courriers</h1>    </div>
    <div  class="col-md-3">

    <a href="{{ route('courriers.create') }}" class="btn  mb-3" style=" background-color: #038C4F; color:white;">Ajouter courrier</a>
</div>    </div>
<br><br>

    <table id="Table" class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Titre</th>
                <th>Expéditeur</th>
                <th>Destinataire</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($courriers as $courrier)
            <tr>
                <td>{{ $courrier->id }}</td>
                <td>{{ $courrier->title }}</td>
                <td>{{ $courrier->sender }}</td>
                <td>{{ $courrier->receiver }}</td>
                <td>
                    <a href="{{ route('courriers.show', $courrier->id) }}" class="btn btn-info">Voir</a>
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
                url: "https://cdn.datatables.net/plug-ins/1.13.6/i18n/fr-FR.json"
            }
        });
    });
</script>
@endpush

