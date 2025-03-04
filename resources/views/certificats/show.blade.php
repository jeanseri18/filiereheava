@extends('layouts.appprint')


@section('content')
<h1 style="margin-top:0pt; margin-bottom:10pt; page-break-after:avoid; line-height:115%; font-size:14pt;"><span
            style="font-family:'Arial Narrow';">N&deg;CNPS EMPLOYEUR</span><span
            style="font-family:'Arial Narrow';">&nbsp;</span><span style="font-family:'Arial Narrow';">: 374353 </span>
    </h1>
<div class=" mt-5">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class=" p-4">
                <div class="text-center mb-4">
                    <h3><strong><u> CERTIFICAT DE TRAVAIL:{{$certificat->id }}</u></strong></h3>
                </div>

                <p>Je soussigné <strong>GBAHI Djoua Luc</strong>, Directeur Exécutif de la Fédération des OPA de Producteurs de la Filière Hévéa de Côte d’Ivoire (FPH-CI), certifie que M./Mme <strong>{{ $certificat->user->name }}</strong>, de numéro CNPS ou numero de paie <strong>{{ $certificat->user->numcnps }}</strong>, a travaillé à la FPH-CI du <strong>{{ \Carbon\Carbon::parse($certificat->date_debut)->format('d/m/Y') }}</strong> au <strong>{{ \Carbon\Carbon::parse($certificat->date_fin)->format('d/m/Y') }}</strong>.</p>

<p>Il y était sous Contrat à Durée Indéterminée (CDI) en qualité de <strong>{{ $certificat->type_contrat }}</strong>.</p>

<p>En foi de quoi, le présent certificat est délivré pour servir et valoir ce que de droit.</p>



                

<br/>
<br/>
<br/>
<br/>
<br/>
                <p class="text-end">
                    Fait à Abidjan, le <strong>{{ now()->format('d/m/Y') }}</strong>
                </p>
                <p class="text-end">
               <strong>Le Directeur Exécutif</strong>
                </p>
                @if($certificat->validation_directeur)
                <p class="text-end"><strong>Validée</strong></p>
            @else
                <p class="text-end"><strong>Non Validée</strong></p>
            @endif
                <p class="text-end">
               <strong>GBAHI Djoua Luc</strong>
                </p>
                
                
            </div>
        </div>
    </div>
</div>
@endsection
