@extends('layouts.appprint')

@section('content')
    <div class="text-center mb-4">
        <h3><strong><u> ATTESTATION DE CONGÉ</u></strong></h3>
    </div>
    <div class="text-left">
        <p><strong>Je soussigné :</strong></p>
        <p><strong>Monsieur :</strong> GBAHI Djoua Luc</p>
        <p><strong>Matricule :</strong>0002B</p>
        <p><strong>Fonction :</strong>  {{ $demande->service_secteur }}</p>
        <p>Atteste que  <strong>{{ $demande->user->nom }} {{ $demande->user->prenom }}</strong></p>
        <p><strong>Matricule :</strong> {{ $demande->user->matricule }}</p>
        <p><strong>Emploi :</strong> {{ $demande->user->fonction }}</p>
        <p>Effectivement en service à la FPH-CI depuis le <strong>02 Novembre 2020</strong></p>
        <p>En qualité de : <strong>{{ $demande->user->fonction }} a la {{ $demande->service_secteur }}</strong></p>
        
        <p><strong>Bénéficie de son congé annuel, allant du :</strong> <u>{{ \Carbon\Carbon::parse($demande->date_debut)->format('d/m/Y') }}</u> <strong>au</strong> <u> {{ \Carbon\Carbon::parse($demande->date_fin)->format('d/m/Y') }} inclus</u></p>
        <p>Elle devra reprendre le service le <strong> @php
    $reprise = \Carbon\Carbon::parse($demande->date_fin)->addDay();
    while ($reprise->isWeekend()) {
        $reprise->addDay();
    }
@endphp

<p>Elle devra reprendre le service le <strong>{{ $reprise->format('d/m/Y') }} à 07h30min</strong>.</p>
 à 07h30min</strong>.</p>
    </div>
    <p class="text-end">
        En foi de quoi, la présente attestation lui est délivrée pour servir et valoir ce que de droit.
    </p>
    <p class="text-end">
        Fait à Abidjan, le <strong>{{ now()->format('d/m/Y') }}</strong>
    </p>
    <div class="row">
        <div class="col-md-6">
            <p class="text-start"><strong>Le Directeur Exécutif :</strong></p>
            <p class="text-start"><strong>GBAHI Djoua Luc</strong></p>
        </div>
        <div class="col-md-6 text-end">
            <img src="{{ asset('images/cachet_signature.png') }}" alt="Cachet et signature" width="200">
        </div>
    </div>
@endsection
