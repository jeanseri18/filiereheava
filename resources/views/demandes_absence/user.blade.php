@extends('layouts.apprh')

@section('content')
<div class="container">
    <h1>Mes Demandes d'Absence</h1>
    <a href="{{ route('demandes_absence.create') }}" class="btn btn-primary">Nouvelle Demande</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table mt-3">
        <thead>
            <tr>
                <th>#</th>
                <th>Matricule</th>
                <th>Poste</th>
                <th>Jours</th>
                <th>Statut</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($demandes as $demande)
            <tr>
                <td>{{ $demande->id }}</td>
                <td>{{ $demande->user->matricule }}</td>
                <td>{{ $demande->user->fonction }}</td>
                <td>{{ $demande->nombre_jours }}</td>
                <td>
                    @if($demande->validation_superieur)
                        <span class="text-success">Validée</span>
                    @else
                        <span class="text-danger">Non validée</span>
                    @endif
                </td>
                <td>
                    <a href="{{ route('demandes_absence.show', $demande->id) }}" class="btn btn-info btn-sm">Voir</a>
                    <a href="{{ route('demandes_absence.edit', $demande->id) }}" class="btn btn-warning btn-sm">Modifier</a>
                    <form action="{{ route('demandes_absence.destroy', $demande->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
