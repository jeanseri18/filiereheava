@extends('layouts.appprint')


@section('content')
<div class=" mt-5">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class=" p-4">
                <div class="text-center mb-4">
                    <h3><strong><u> AUTORISATION D'ABSENCE:{{$autorisation->id }}</u></strong></h3>
                </div>

                <p>Je soussigné <strong>GBAHI Djoua Luc</strong>, Directeur Exécutif de la FPH-CI, autorise M./Mme <strong>{{ $autorisation->user->name }}</strong>, Fonction <strong>{{ $autorisation->user->fonction }}</strong>, à s'absenter du <strong>{{ \Carbon\Carbon::parse($autorisation->date_debut)->format('d/m/Y') }}</strong> au <strong>{{ \Carbon\Carbon::parse($autorisation->date_fin)->format('d/m/Y') }}</strong>, soit <strong>{{ $autorisation->nombre_jours }} jours</strong> pour <strong>{{ $autorisation->raison }}</strong>.</p>

<p>En foi de quoi, cette présente lui est délivrée pour servir et valoir ce que de droit.</p>


                

<br/>
<br/>
<br/>
<br/>
<br/>
                <p class="text-end">
                    Fait à Abidjan, le <strong>{{ now()->format('d/m/Y') }}</strong>
                </p>
                <p class="text-end">
               <strong>Le GBAHI Djoua Luc</strong>
                </p>
                @if($autorisation->validation_directeur)
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
