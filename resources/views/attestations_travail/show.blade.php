@extends('layouts.appprint')

@section('title', 'Attestation de Travail')

@section('content')
<h1 style="margin-top:0; margin-bottom:10pt; line-height:115%; font-size:12pt;">
    <span style="font-family:'Arial Narrow';">N° CNPS EMPLOYEUR : 374353</span>
</h1>

<div class="text-center mb-4" style="margin-top: 30px;">
    <h3><strong><u>ATTESTATION DE TRAVAIL : {{ $attestation->id }}</u></strong></h3>
</div>

<div style="text-align: justify; font-size: 12pt;">
    <p>
        Je soussigné <strong>GBAHI Djoua Luc</strong>, Directeur Exécutif de la Fédération des OPA de Producteurs
        de la Filière Hévéa de Côte d'Ivoire (FPH-CI), atteste que <strong>M./Mme {{ $attestation->user->nom }}</strong>,
        de numéro matricule <strong>{{ $attestation->user->matricule }}</strong>, travaille au sein de ma structure
        depuis le <strong>{{ $attestation->date_embauche->format('d/m/Y') }}</strong>.
    </p>

    <p>
        Il/Elle y est sous {{ $attestation->type_contrat }} en qualité de {{ $attestation->user->fonction }}
        au {{ $attestation->lieu_travail }} de la FPH-CI.
    </p>

    <p>
        En foi de quoi, je lui délivre la présente attestation pour servir et valoir ce que de droit.
    </p>
</div>

<div style="margin-top: 80px;">
    <p class="text-end">
        Fait à Abidjan, le <strong>{{ $attestation->created_at->format('d/m/Y') }}</strong>
    </p>
    <p class="text-end" style="margin-top: 10px;">
        <strong>Le Directeur Exécutif</strong>
    </p>
    
    <p class="text-end" style="margin-top: 40px;">
        <strong>GBAHI Djoua Luc</strong>
    </p>
    
    <p class="text-end" style="color:green; margin-top: 5px;">
        <strong>{{ $attestation->validation_directeur ? 'Validée' : 'Non validée' }}</strong>
    </p>
</div>
@endsection