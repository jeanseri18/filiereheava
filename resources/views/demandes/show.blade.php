@extends('layouts.appprint')

@section('content')
    <div class="text-center mb-4">
        <h3><strong><u> DEMANDE DE DEPART EN CONGE</u></strong></h3>
    </div>
    <div class="text-left">
        <p><strong>NOM & Prénoms :</strong> {{ $demande->user->nom }} {{ $demande->user->prenom }}</p>
        <p><strong>N° Matricule :</strong> {{ $demande->user->matricule }}</p>
        <p><strong>Fonction :</strong> {{ $demande->user->fonction }}</p>
        <p><strong>Service / Secteur :</strong> {{ $demande->service_secteur }}</p>
        <p><strong>Motif :</strong> {{ $demande->motif }}</p>
        
        <p><strong>Période de congé accordé du :</strong> {{ \Carbon\Carbon::parse($demande->date_debut)->format('d/m/Y') }} 
        <strong>au</strong> {{ \Carbon\Carbon::parse($demande->date_fin)->format('d/m/Y') }}</p>
        
        <p><strong>Nombre de jours ouvrables :</strong> {{ $demande->nombre_jours_ouvrables }}
        <strong>soit</strong> {{ $demande->nombre_jours_calendaires }} <strong>jours calendaires</strong></p>
        
        <p><strong>Adresse et lieu(x) de séjour durant les congés :</strong> {{ $demande->adresse_sejour }}</p>
        
        <p><strong>Nom de la personne devant assurer l’intérim (éventuellement) :</strong> {{ $demande->nom_interimaire ?? 'N/A' }}</p>
        
        <p><strong>Qualification de l’intérimaire :</strong> {{ $demande->qualification_interimaire ?? 'N/A' }}</p>
        
        <p><strong>Fonction de l’intérimaire :</strong> {{ $demande->fonction_interimaire ?? 'N/A' }}</p>
        
        
    </div><p class="text-end">
                    Fait à Abidjan, le <strong><strong>{{ now()->format('d/m/Y') }}</strong></strong>
                </p>
     <div class="row">
        <div class="col-md-6">        <p class="text-start"><strong>Signature du demandeur :</strong> <br>{{ $demande->signature_demandeur ?? 'Non signée' }}</p>
        </div>
        <div class="col-md-6">        <p class="text-end"><strong>Avis du supérieur :</strong> <br>{{ $demande->avis_superieur ?? 'Non renseigné' }}</p>
        </div>
     </div>
@endsection
