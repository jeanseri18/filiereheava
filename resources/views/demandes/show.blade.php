@extends('layouts.appprint')

@section('title', 'Demande de départ en congé')

@section('content')
<div class="text-center mb-4">
    <h3><strong><u>DEMANDE DE DEPART EN CONGE</u></strong></h3>
</div>

<div class="text-left">
    <table style="width: 100%; border-collapse: collapse; margin-bottom: 15px;">
        <tr>
            <td style="width: 40%;"><strong>NOM & Prénoms :</strong></td>
            <td style="width: 60%;"><strong>{{ $demande->user->nom }} {{ $demande->user->prenom }}</strong></td>
        </tr>
        <tr>
            <td><strong>N° Matricule :</strong></td>
            <td>{{ $demande->user->matricule }}</td>
        </tr>
        <tr>
            <td><strong>Fonction :</strong></td>
            <td>{{ $demande->user->fonction }}</td>
        </tr>
        <tr>
            <td><strong>Service / Secteur :</strong></td>
            <td>{{ $demande->service_secteur }}</td>
        </tr>
        <tr>
            <td><strong>Motif :</strong></td>
            <td>{{ $demande->motif }}</td>
        </tr>
        <tr>
            <td><strong>Période de congé accordé du :</strong></td>
            <td>{{ \Carbon\Carbon::parse($demande->date_debut)->format('d/m/Y') }} <strong>au</strong> {{ \Carbon\Carbon::parse($demande->date_fin)->format('d/m/Y') }}</td>
        </tr>
        <tr>
            <td><strong>Nombre de jours ouvrables :</strong></td>
            <td>{{ $demande->nombre_jours_ouvrables }} <strong>soit</strong> {{ $demande->nombre_jours_calendaires }} <strong>jours calendaires</strong></td>
        </tr>
        <tr>
            <td><strong>Adresse et lieu(x) de séjour :</strong></td>
            <td>{{ $demande->adresse_sejour }}</td>
        </tr>
        <tr>
            <td><strong>Nom de la personne assurant l'intérim :</strong></td>
            <td>{{ $demande->nom_interimaire ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td><strong>Qualification de l'intérimaire :</strong></td>
            <td>{{ $demande->qualification_interimaire ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td><strong>Fonction de l'intérimaire :</strong></td>
            <td>{{ $demande->fonction_interimaire ?? 'N/A' }}</td>
        </tr>
    </table>

    <p class="text-end" style="margin-top: 40px;">
        Fait à Abidjan, le <strong>{{ now()->format('d/m/Y') }}</strong>
    </p>

    <div class="row" style="margin-top: 40px;">
        <div class="col-md-6 text-start">
            <p><strong>Signature du demandeur :</strong><br>
            {{ $demande->signature_demandeur ?? 'Non signée' }}</p>
        </div>
        <div class="col-md-6 text-end">
            <p><strong>Avis du supérieur :</strong><br>
            {{ $demande->avis_superieur ?? 'Non renseigné' }}</p>
        </div>
    </div>
</div>
@endsection