@extends('layouts.appprint')


@section('content')
<!-- <div class="text-end mb-3 no-print">
    <a href="{{ route('demandes.pdf', $demande->id) }}" class="btn btn-primary" target="_blank">Télécharger PDF</a>
    <a href="{{ route('demandes.index') }}" class="btn btn-secondary">Retour à la liste</a>
</div> -->

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
            <td>{{ $demande->service->nom ?? $demande->user->service->nom ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td><strong>Motif :</strong></td>
            <td>{{ $demande->motif }}</td>
        </tr>
        <tr>
            <td><strong>Période de congé accordé du :</strong></td>
            <td>{{ \Carbon\Carbon::parse($demande->date_debut)->locale('fr')->isoFormat('D MMMM YYYY') }} <strong>au</strong> {{ \Carbon\Carbon::parse($demande->date_fin)->locale('fr')->isoFormat('D MMMM YYYY') }}</td>
        </tr>
        <tr>
            <td><strong>Nombre de jours calendaires :</strong></td>
            <td>{{ $demande->nombre_jours_calendaires }}</td>
        </tr>
        <tr>
            <td><strong>Adresse et lieu(x) de séjour :</strong></td>
            <td>{{ $demande->adresse_sejour }}</td>
        </tr>
        @if($demande->getLastLeaveDate())
        <tr>
            <td><strong>Date du dernier congé :</strong></td>
            <td>{{ \Carbon\Carbon::parse($demande->getLastLeaveDate())->locale('fr')->isoFormat('D MMMM YYYY') }}</td>
        </tr>
        @endif
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
        <tr>
            <td><strong>Supérieur hiérarchique :</strong></td>
            <td>{{ $demande->superieur->nom ?? 'N/A' }} {{ $demande->superieur->prenom ?? '' }}</td>
        </tr>
    </table>

<!-- 

    @if($demande->nom_interimaire || $demande->qualification_interimaire || $demande->fonction_interimaire)
    <div class="row mt-3">
        <div class="col-12">
            <h5>Informations sur l'intérimaire</h5>
        </div>
        @if($demande->nom_interimaire)
        <div class="col-md-4">
            <p><strong>Nom de la personne assurant l'intérim :</strong><br>
            {{ $demande->nom_interimaire }}</p>
        </div>
        @endif
        @if($demande->qualification_interimaire)
        <div class="col-md-4">
            <p><strong>Qualification de l'intérimaire :</strong><br>
            {{ $demande->qualification_interimaire }}</p>
        </div>
        @endif
        @if($demande->fonction_interimaire)
        <div class="col-md-4">
            <p><strong>Fonction de l'intérimaire :</strong><br>
            {{ $demande->fonction_interimaire }}</p>
        </div>
        @endif
    </div>
    @endif -->

        <p class="text-end" style="margin-top: 40px;">
        Fait à Abidjan, le <strong>{{ now()->locale('fr')->isoFormat('D MMMM YYYY') }}</strong>
    </p>

    <div class="row" style="margin-top: 40px;">
        <div class="col-md-6 text-start">
            <p><strong>Signature du demandeur :</strong><br>
            <!-- {{ $demande->signature_demandeur ?? 'Non signée' }}</p> -->
        </div>
        {{-- <div class="col-md-6 text-end">
            <p><strong>Avis du supérieur :</strong><br>
            {{ $demande->avis_superieur ?? 'Non renseigné' }}</p>
        </div> --}}
    </div>
</div>

<!-- <style>
@media print {
    .no-print {
        display: none !important;
    }
}
</style> -->
@endsection