@extends('layouts.appprint')

@section('content')
<h1 style="margin-top:0pt; margin-bottom:10pt; page-break-after:avoid; line-height:115%; font-size:14pt;">
    <span style="font-family:'Arial Narrow';">N° CNPS EMPLOYEUR : 374353</span>
</h1>

<div class="mt-5">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="p-4">
                <div class="text-center mb-4">
                    <h3><strong><u>ATTESTATION DE REPRISE DE SERVICE : {{ $attestation->id }}</u></strong></h3>
                </div>

                <p>
                    Je soussigné <strong>GBAHI Djoua Luc</strong>, Directeur Exécutif de la Fédération des OPA de Producteurs 
                    de la Filière Hévéa de Côte d’Ivoire (FPH-CI), atteste que 
                    <strong>{{ $attestation->nom }}</strong> 
                    (CNPS N° <strong>{{ $attestation->numero_cnps ?? 'N/A' }}</strong>),
                    a bien repris son service au poste de <strong>{{ $attestation->poste }}</strong> 
                    dans le service <strong>{{ $attestation->service }}</strong>.
                </p>

                <p>
                    La reprise effective a eu lieu le <strong>{{ date('d/m/Y', strtotime($attestation->date_reprise)) }}</strong> 
                    à <strong>{{ $attestation->lieu }}</strong>.
                </p>

                <p>
                    En foi de quoi, le présent certificat est délivré pour servir et valoir ce que de droit.
                </p>

                <br><br><br><br><br>

                <p class="text-end">
                    Fait à Abidjan, le <strong>{{ now()->format('d/m/Y') }}</strong>
                </p>

                <p class="text-end">
                    <strong>GBAHI Djoua Luc</strong><br>
                    Directeur Exécutif
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
