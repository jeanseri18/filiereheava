@extends('layouts.appprint')

@section('content')
  <bR>
  <bR>
  <bR>
  <bR>
            <div class="text-center mb-4">
                <h3><strong><u>ORDRE DE MISSION</u></strong></h3>
            </div>

            <div class="text-left">
                <p><strong>Nom & Prénoms :</strong> {{ $ordre->user->nom }}</p>
                <p><strong>Emploi occupé :</strong> {{ $ordre->emploi_occupe }}</p>
                <p><strong>Lieu de Mission :</strong> {{ $ordre->lieu_mission }}</p>
                <p><strong>Objet de la Mission :</strong> {{ $ordre->objet_mission }}</p>
                <p><strong>Moyen de Transport :</strong> {{ $ordre->moyen_transport }}</p>

                <p><strong>Période de mission :</strong> 
                    du {{ \Carbon\Carbon::parse($ordre->date_depart)->format('d/m/Y') }} 
                    au {{ \Carbon\Carbon::parse($ordre->date_retour)->format('d/m/Y') }}
                </p>

                <p><strong>Lieu de création :</strong> {{ $ordre->lieu_creation }}</p>
                <p><strong>Date de création :</strong> {{ \Carbon\Carbon::parse($ordre->date_creation)->format('d/m/Y') }}</p>
            </div>

            <p class="text-end mt-5">
                Fait à {{ $ordre->lieu_creation }}, le <strong>{{ \Carbon\Carbon::parse($ordre->date_creation)->format('d/m/Y') }}</strong>
            </p>

            <p class="text-end"><strong>Le Directeur Exécutif</strong></p>
            <p class="text-end"><strong>GBAHI Djoua Luc</strong></p>

   

@endsection
