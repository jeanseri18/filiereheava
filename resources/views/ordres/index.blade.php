@extends('layouts.apprh')

@section('content')
<div class="container">
    <div class="row mb-4">
    @php
                $permission = Auth::user()->permissionrh ?? null;
            @endphp
        <div class="col-md-9">
        @if(in_array($permission, ['rh', 'valideur']))

            <h1 class="text-2xl font-bold">Liste des  Ordres de Mission </h1>
            @else
            <h1 class="text-2xl font-bold">Mes Ordres de Mission </h1>
            @endif
        </div>
        <div class="col-md-3 text-end">
       

            @if(in_array($permission, ['rh', 'valideur']))
                <a href="{{ route('ordres.create') }}" class="btn btn-success">Nouvel Ordre de Mission</a>
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
                            <th>Employé</th>
                            <th>Lieu de Mission</th>
                            <th>Objet</th>
                            <th>Dates</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($ordres as $ordre)
                            <tr>
                                <td>{{ $ordre->user->nom ?? '' }}</td>
                                <td>{{ $ordre->lieu_mission }}</td>
                                <td>{{ $ordre->objet_mission }}</td>
                                <td>{{ \Carbon\Carbon::parse($ordre->date_depart)->format('d/m/Y') }} - {{ \Carbon\Carbon::parse($ordre->date_retour)->format('d/m/Y') }}</td>
                                <td class="text-center">
                                    <a href="{{ route('ordres.show', $ordre) }}" class="btn btn-info btn-sm mb-1">Voir</a>

                                    <form action="{{ route('ordres.destroy', $ordre) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Confirmer la suppression ?')">Supprimer</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@push('styles')
<link href="https://cdn.datatables.net/v/bs5/jq-3.7.0/dt-2.1.8/datatables.min.css" rel="stylesheet">
@endpush

@push('scripts')
<script src="https://cdn.datatables.net/v/bs5/jq-3.7.0/dt-2.1.8/datatables.min.js"></script>
<script>
    $(document).ready(function () {
        $('#Table').DataTable({
            responsive: true,
            language: {
                url: "https://cdn.datatables.net/plug-ins/1.13.6/i18n/fr-FR.json"
            }
        });
    });
</script>
@endpush
@endsection
