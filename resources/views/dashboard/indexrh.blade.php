@extends('layouts.apprh')

@section('title', 'Dashboard')

@push('styles')
<style>
/* Supprimer les soulignements des liens */
a {
    text-decoration: none;
}

/* Uniformiser la hauteur des cartes */
.dashboard-block {
    height: 100%;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    align-items: flex-start;
}

.dashboard-block {
    backgroun-color: #f8f9fa;
    border: 1px solid #ddd;
    border-radius: 8px;
    padding: 20px;"
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    text-align: left;
}

.dashboard-block i {
    font-size: 2.5rem;
    color: black;
    margin-right: 15px;
}

.dashboard-block h3, .dashboard-block h6 {
    margin-bottom: 0;
}

.dashboard-block p {
    font-size: 1rem;
    color: #6c757d;
    margin-top: 5px;
}

.status-valid {
    color: #FCFCFCFF;
    font-weight: bold;
}

.status-reject {
    color: white;
    font-weight: bold;
}

</style>
@endpush

@section('content')

<div class="container mt-1">
    <h2 class="mb-4">Statistiques du Tableau de Bord</h2>

    <div class="row">
        <!-- Attestations de Stage -->
        <div class="col-md-4">
            <div class="card shadow-sm" style="background-color:#038c4f;color:white">
                <div class="card-body">
                    <h3 class="card-title" style="font-size: 20px;"> Attestations de Stage</h3></br>
                    <p class="fs-3 text-white" style="font-size:35px">{{ $stats['attestations_stage'] }}</p>
                    <p>Validées : <span class="status-valid">{{ $stats['attestations_stage_validees'] }}</span></p>
                    <p>Rejetées : <span class="status-reject">{{ $stats['attestations_stage_rejetees'] }}</span></p>
                </div>
            </div>
        </div>

        <!-- Attestations de Travail -->
        <div class="col-md-4">
            <div class="card shadow-sm" style="background-color:#038c4f;color:white">
                <div class="card-body">
                    <h3 class="card-title" style="font-size: 20px;"> Attestations de Travail</h3></br>
                    <p class="fs-3 text-white" style="font-size:35px">{{ $stats['attestations_travail'] }}</p>
                    <p>Validées : <span class="status-valid">{{ $stats['attestations_travail_validees'] }}</span></p>
                    <p>Rejetées : <span class="status-reject">{{ $stats['attestations_travail_rejetees'] }}</span></p>
                </div>
            </div>
        </div>

        <!-- Certificats de Travail -->
        <div class="col-md-4">
            <div class="card shadow-sm" style="background-color:#038c4f;color:white">
                <div class="card-body">
                    <h3 class="card-title" style="font-size: 20px;">Certificats de Travail</h3></br>
                    <p class="fs-3 text-white" style="font-size:35px">{{ $stats['certificats_travail'] }}</p>
                    <p>Validés : <span class="status-valid">{{ $stats['certificats_travail_validees'] }}</span></p>
                    <p>Rejetés : <span class="status-reject">{{ $stats['certificats_travail_rejetees'] }}</span></p>
                </div>
            </div>
        </div>

        <!-- Demandes d'Absence -->
        <div class="col-md-4 mt-4">
            <div class="card shadow-sm" style="background-color:#038c4f;color:white">
                <div class="card-body">
                    <h3 class="card-title" style="font-size: 20px;">Demandes d'Absence</h3></br>
                    <p class="fs-3 text-white" style="font-size:35px">{{ $stats['demandes_absence'] }}</p>
                </div>
            </div>
        </div>

        <!-- Autorisations d'Absence -->
        <div class="col-md-4 mt-4">
            <div class="card shadow-sm" style="background-color:#038c4f;color:white">
                <div class="card-body">
                    <h3 class="card-title" style="font-size: 20px;"> Autorisations d'Absence</h3></br>
                    <p class="fs-3 text-white" style="font-size:35px">{{ $stats['autorisations_absence'] }}</p>
                </div>
            </div>
        </div>

        <!-- Demandes de Congés -->
        <div class="col-md-4 mt-4">
            <div class="card shadow-sm" style="background-color:#038c4f;color:white">
                <div class="card-body">
                    <h3 class="card-title" style="font-size: 20px;"> Demandes de Congés</h3></br>
                    <p class="fs-3 text-white" style="font-size:35px">{{ $stats['demandes_depart_conges'] }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Graphique -->
    <div class="mt-5" style="height:350px">
        <h2 class="text-left">Évolution des demandes validées</h2>
        <canvas id="statsChart"></canvas>
    </div>
</div>

@endsection
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const ctx = document.getElementById('statsChart').getContext('2d');
        
        const statsChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: [
                    'Attestations Stage', 
                    'Attestations Travail', 
                    'Certificats Travail', 
                    'Autorisations Absence', 
                    'Demandes Absence Validées', 
                    'Demandes Absence Rejetées', 
                    'Congés Validés', 
                    'Congés Rejetés'
                ],
                datasets: [{
                    label: 'Nombre de demandes validées',
                    data: [
                        {{ $stats['attestations_stage_validees'] }},
                        {{ $stats['attestations_travail_validees'] }},
                        {{ $stats['certificats_travail_validees'] }},
                        {{ $stats['autorisations_absence'] }},
                        {{ $stats['demandes_absence_validees'] }},
                        {{ $stats['demandes_absence_rejetees'] }},
                        {{ $stats['demandes_depart_conges_validees'] }},
                        {{ $stats['demandes_depart_conges_rejetees'] }}
                    ],
                    backgroundColor: [
                        '#4CAF50', '#FFC107', '#111315', 
                        '#FF5722', '#9C27B0', '#795548', 
                        '#3F51B5', '#E91E63'
                    ]
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    });
</script>
@endpush
