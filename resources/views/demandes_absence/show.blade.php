
@extends('layouts.appprint')

@section('content')
    <div class="text-center mb-4">
        <h3><strong><u> DEMANDE D’ABSENCE <br>     N° {{ $demande->id }} </u></strong></h3>
    </div>
    
    <div class="text-left">
   
        <br>M/Mme/Mlle : <strong>{{ $demande->user->nom ?? '' }} {{ $demande->user->prenom ?? '' }}</strong>  
        Fonction : <strong>{{ $demande->user->fonction ?? '' }}</strong>  
        N° Matricule : <strong>{{ $demande->user->matricule ?? '' }}</strong>  
        
        <br>Sollicite une permission de <strong>{{ $demande->nombre_jours }}</strong> jours,  
        du <strong>{{ \Carbon\Carbon::parse($demande->date_debut)->format('d/m/Y') }}</strong>  
        au <strong>{{ \Carbon\Carbon::parse($demande->date_fin)->format('d/m/Y') }}</strong>  

        <br>Objet de la demande : <strong>{{ $demande->objet_demande }}</strong>  

        <br>
        <br>
        <br>
        <br>
        <br>
        Abidjan, le <strong>{{ \Carbon\Carbon::parse($demande->date_creation)->format('d/m/Y') }}</strong>  

        <div class="row">
        <div class="col-md-6">        <p class="text-start"><strong>Signature du demandeur :</strong> <br>{{ $demande->signature_demandeur ?? 'Non signée' }}</p>
        </div>
        <div class="col-md-6">        <p class="text-end"><strong>Avis du supérieur :</strong> <br>{{ $demande->avis_superieur ?? 'Non renseigné' }}</p>
        </div>
     </div>
    </div>
@endsection

