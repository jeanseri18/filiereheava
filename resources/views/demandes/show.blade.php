@extends('layouts.apprh')

@section('content')
    <h1>Demande de départ en congés</h1>
    <p><strong>Matricule :</strong> {{ $demande->user->matricule }}</p>
    <p><strong>Fonction :</strong> {{ $demande->user->fonction }}</p>
    <p><strong>Service/Secteur :</strong> {{ $demande->service_secteur }}</p>
    <p><strong>Motif :</strong> {{ $demande->motif }}</p>
    <p><strong>Date début :</strong> {{ $demande->date_debut }}</p>
    <p><strong>Date fin :</strong> {{ $demande->date_fin }}</p>
    <p><strong>Adresse de séjour :</strong> {{ $demande->adresse_sejour }}</p>
    
    <a href="{{ route('demandes.edit', $demande->id) }}">Modifier</a>
    <form action="{{ route('demandes.destroy', $demande->id) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit">Supprimer</button>
    </form>
@endsection
