@extends('layouts.appprint')

@section('title', 'Attestation de Reprise de Service')

@section('content')
<h1 style="margin-top:0; margin-bottom:10pt; line-height:115%; font-size:12pt;">
    <span style="font-family:'Arial Narrow';">N° CNPS EMPLOYEUR : 374353</span>
</h1>

<div class="text-center mb-4" style="margin-top: 30px;">
    <h3><strong><u>ATTESTATION DE REPRISE DE SERVICE : {{ $attestation->id }}</u></strong></h3>
</div>

<div style="text-align: justify; font-size: 12pt;">
    <p>
        Je soussigné <strong>GBAHI Djoua Luc</strong>, Directeur Exécutif de la Fédération des OPA de Producteurs
        de la Filière Hévéa de Côte d'Ivoire (FPH-CI), atteste que <strong>{{ $attestation->nom }}</strong>
        (CNPS N° <strong>{{ $attestation->numero_cnps ?? 'N/A' }}</strong>), a bien repris son service au poste
        de <strong>{{ $attestation->poste }}</strong> dans le service <strong>{{ $attestation->service }}</strong>.
    </p>

    <p>
        La reprise effective a eu lieu le <strong>{{ date('d/m/Y', strtotime($attestation->date_reprise)) }}</strong>
        à <strong>{{ $attestation->lieu }}</strong>.
    </p>

    <p>
        En foi de quoi, le présent certificat est délivré pour servir et valoir ce que de droit.
    </p>
</div>

<div style="margin-top: 80px;">
    <p class="text-end">
        Fait à Abidjan, le <strong>{{ now()->format('d/m/Y') }}</strong>
    </p>
    <p class="text-end" style="margin-top: 10px;">
        <strong>Le Directeur Exécutif</strong>
    </p>
    
    <p class="text-end" style="margin-top: 40px;">
        <strong>GBAHI Djoua Luc</strong>
    </p>
</div>
@endsection