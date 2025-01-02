@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Liste des historiques</h1>
        <br><br>
        <table id="Table" class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Action</th>
                    <th>Document</th>
                    <th>Utilisateur</th>
                    <th>Date de l'action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($histories as $history)
                    <tr>
                        <td>{{ $history->id }}</td>
                        <td>{{ $history->action }}</td>
                        <td>{{ $history->document->nom ?? 'N/A' }}</td> <!-- Nom du document -->
                        <td>{{ $history->user->name ?? 'N/A' }}</td> <!-- Nom de l'utilisateur -->
                        <td>{{ $history->action_date }}</td>
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

