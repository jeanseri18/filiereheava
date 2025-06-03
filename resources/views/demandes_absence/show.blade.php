@extends('layouts.appprint')

@section('title', 'Demande d\'absence')

@section('content')
<div class="text-center mb-4">
    <h3><strong><u>DEMANDE D'ABSENCE<br>N° {{ $demande->id }}</u></strong></h3>
</div>

<div class="text-left">
    <table style="width: 100%; border-collapse: collapse; margin-bottom: 15px;">
        <tr>
            <td style="width: 30%;">M/Mme/Mlle :</td>
            <td style="width: 70%;"><strong>{{ $demande->user->nom ?? '' }} {{ $demande->user->prenom ?? '' }}</strong></td>
        </tr>
        <tr>
            <td>Fonction :</td>
            <td><strong>{{ $demande->user->fonction ?? '' }}</strong></td>
        </tr>
        <tr>
            <td>N° Matricule :</td>
            <td><strong>{{ $demande->user->matricule ?? '' }}</strong></td>
        </tr>
    </table>

    <p>Sollicite une permission de <strong>{{ $demande->nombre_jours }}</strong> jours,
    du <strong>{{ \Carbon\Carbon::parse($demande->date_debut)->format('d/m/Y') }}</strong>
    au <strong>{{ \Carbon\Carbon::parse($demande->date_fin)->format('d/m/Y') }}</strong></p>

    <p>Objet de la demande : <strong>{{ $demande->objet_demande }}</strong></p>

    <div style="margin-top: 80px;">
        <p style="text-align: right;">Abidjan, le <strong>{{ \Carbon\Carbon::parse($demande->date_creation)->format('d/m/Y') }}</strong></p>

        <div class="row" style="margin-top: 40px;">
            <div class="col-md-6 text-start">
                <p><strong>Signature du demandeur :</strong><br>
                {{ $demande->signature_demandeur ?? 'Non signée' }}</p>
            </div>
            <div class="col-md-11 text-end" style="text-align: right;">
                <p  style="text-align: right;"><strong>Avis du supérieur :</strong><br>
                {{ $demande->validation_superieur ? 'Accordée' : 'Non validée' }}</p>
            </div>
        </div>
    </div>
</div>
@endsection