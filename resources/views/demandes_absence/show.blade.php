@extends('layouts.apprh')

@section('content')
<div class="container">
    <h1>Demande d'Absence - #{{ $demande->id }}</h1>

    <table class="table mt-3">
        <tbody>
            <tr>
                <th>Numéro de Demande</th>
                <td>{{ $demande->num_demande }}</td>
            </tr>
            <tr>
                <th>Matricule</th>
                <td>{{ $demande->user->matricule }}</td>
            </tr>
            <tr>
                <th>Poste</th>
                <td>{{ $demande->user->fonction }}</td>
            </tr>
            <tr>
                <th>Nombre de Jours</th>
                <td>{{ $demande->nombre_jours }}</td>
            </tr>
            <tr>
                <th>Dates</th>
                <td>{{ $demande->date_debut }} - {{ $demande->date_fin }}</td>
            </tr>
            <tr>
                <th>Objet de la Demande</th>
                <td>{{ $demande->objet_demande }}</td>
            </tr>
            <tr>
                <th>Supérieur</th>
                <td>{{ $demande->id_superieur ? App\Models\User::find($demande->id_superieur)->name : 'Non spécifié' }}</td>
            </tr>
            <tr>
                <th>Statut</th>
                <td>
                    @if($demande->validation_superieur)
                        <span class="text-success">Validée</span>
                    @else
                        <span class="text-danger">Non validée</span>
                    @endif
                </td>
            </tr>
            <tr>
                <th>Date de Création</th>
                <td>{{ $demande->date_creation }}</td>
            </tr>
            <tr>
                <th>Date de Validation</th>
                <td>{{ $demande->date_validation ?? 'Non validée' }}</td>
            </tr>
            <tr>
                <th>Signature du Demandeur</th>
                <td>{{ $demande->signature_demandeur ?? 'Non signée' }}</td>
            </tr>
        </tbody>
    </table>

    <a href="{{ route('demandes_absence.index') }}" class="btn btn-secondary">Retour à la liste</a>
</div>
@endsection
