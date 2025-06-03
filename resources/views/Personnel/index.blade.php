@extends('layouts.apprh')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-9">
            <h1>Liste du Personnel</h1>
        </div>
        <div class="col-md-3">
            <a href="{{ route('personnel.create') }}" class="btn btn-success mb-3">Ajouter un employé</a>
        </div>
    </div>
    
    <br>
    
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
    
    <div class="card custom-card">
        <div class="card-body">
            <table id="personnelTable" class="table table-bordered table-striped">
                <thead class="table-success">
                    <tr>
                        <th>Photo</th>
                        <th>Matricule</th>
                        <th>Nom</th>
                        <th>Fonction</th>
                        <th>Service</th>
                        <th>Email</th>
                        <th>Rôle</th>
                        <th>Statut</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td class="text-center">
                                @if($user->file_url)
                                    <img src="{{ asset($user->file_url) }}" alt="Photo" class="rounded-circle" width="40" height="40">
                                @else
                                    <i class="bi bi-person-circle" style="font-size: 2rem;"></i>
                                @endif
                            </td>
                            <td>{{ $user->matricule }}</td>
                            <td>{{ $user->nom }}</td>
                            <td>{{ $user->fonction }}</td>
                            <td>{{ $user->service->nom_service ?? 'Non défini' }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->role }}</td>
                            <td>
                                @if($user->status == 'actif')
                                    <span class="badge bg-success">Actif</span>
                                @else
                                    <span class="badge bg-danger">Inactif</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('personnel.show', $user->id) }}" class="btn btn-info btn-sm">
                                    <i class="bi bi-eye"></i> Détails
                                </a>
                                <a href="{{ route('personnel.edit', $user->id) }}" class="btn btn-warning btn-sm">
                                    <i class="bi bi-pencil"></i> Modifier
                                </a>
                                <form action="{{ route('personnel.destroy', $user->id) }}" method="POST" class="d-inline">
                                    @csrf 
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet employé?')">
                                        <i class="bi bi-trash"></i> Supprimer
                                    </button>
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
    
    .badge {
        font-size: 0.8rem;
        padding: 0.35em 0.65em;
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
        $('#personnelTable').DataTable({
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