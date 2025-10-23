@extends('layouts.appprint')

@section('title', 'Autorisation d\'Absence')

@section('content')
<div class="text-center mb-4" style="margin-top: 50px;">
    <h3><strong><u>AUTORISATION D'ABSENCE : {{$autorisation->id }}</u></strong></h3>
</div>

<div style="text-align: justify; font-size: 12pt;">
    <p>
        Je soussigné <strong>GBAHI Djoua Luc</strong>, Directeur Exécutif de la FPH-CI, autorise 
        M./Mme <strong>{{ $autorisation->user->nom }}</strong>, Fonction <strong>{{ $autorisation->user->fonction }}</strong>, 
        à s'absenter du <strong>{{ \Carbon\Carbon::parse($autorisation->date_debut)->locale('fr')->isoFormat('D MMMM YYYY') }}</strong> 
        au <strong>{{ \Carbon\Carbon::parse($autorisation->date_fin)->locale('fr')->isoFormat('D MMMM YYYY') }}</strong>, 
        soit <strong>{{ $autorisation->nombre_jours }} jours</strong> pour <strong>{{ $autorisation->raison }}</strong>.
    </p>

    <p>
        En foi de quoi, cette présente lui est délivrée pour servir et valoir ce que de droit.
    </p>
</div>

<div style="margin-top: 80px;">
    <p class="text-end">
        Fait à Abidjan, le <strong>{{ now()->locale('fr')->isoFormat('D MMMM YYYY') }}</strong>
    </p>
    <p class="text-end" style="margin-top: 10px;">
        <strong>Le Directeur Exécutif</strong>
    </p>
    
    <p class="text-end" style="margin-top: 40px;">
        <strong>GBAHI Djoua Luc</strong>
    </p>
    
    {{-- <p class="text-end" style="color:green; margin-top: 5px;">
        <strong>{{ $autorisation->validation_directeur ? 'Validée' : 'Non Validée' }}</strong>
    </p> --}}
</div>
@endsection