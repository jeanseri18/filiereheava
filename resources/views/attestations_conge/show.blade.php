@extends('layouts.apprh')

@section('content')
<div class="container">
    <div class="row no-print">
        <div class="col-md-9">
            <h1>Attestation de Congé #{{ $attestation->id }}</h1>
        </div>
        <div class="col-md-3">
            <a href="{{ route('attestations_conge.index') }}" class="btn btn-secondary">Retour à la liste</a>
            <button onclick="window.print()" class="btn btn-primary">Imprimer</button>
        </div>
    </div>
    <br>
    
    @if(session('success'))
        <div class="alert alert-success no-print">
            {{ session('success') }}
        </div>
    @elseif(session('error'))
        <div class="alert alert-danger no-print">
            {{ session('error') }}
        </div>
    @endif

    <!-- Attestation Content -->
    <div class="attestation-content">
        <div class="header-section">
            <div class="row">
                <div class="col-md-6">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo" class="logo" style="max-height: 80px;">
                </div>
                <div class="col-md-6 text-end">
                    <h5>RÉPUBLIQUE DU BÉNIN</h5>
                    <p>MINISTÈRE DE L'ENSEIGNEMENT SUPÉRIEUR<br>
                    ET DE LA RECHERCHE SCIENTIFIQUE</p>
                </div>
            </div>
            <hr>
        </div>
        
        <div class="title-section text-center">
            <h2><u>ATTESTATION DE CONGÉ</u></h2>
            <p>Année {{ $attestation->annee }}</p>
        </div>
        
        <div class="content-section">
            <p>Je soussigné, <strong>Directeur Exécutif</strong> de la Filière Halieutique et Aquacole de l'Université Nationale d'Agriculture,</p>
            
            <p><strong>ATTESTE QUE :</strong></p>
            
            <div class="employee-info">
                <p><strong>Nom et Prénoms :</strong> {{ $attestation->user->nom }} {{ $attestation->user->prenom }}</p>
                <p><strong>Matricule :</strong> {{ $attestation->user->matricule }}</p>
                <p><strong>Fonction :</strong> {{ $attestation->user->fonction ?? 'Non spécifiée' }}</p>
                <p><strong>Service :</strong> {{ $attestation->user->service ?? 'Non spécifié' }}</p>
            </div>
            
            <p>A bénéficié d'un congé administratif pour la période du <strong>{{ $attestation->date_debut_periode->format('d/m/Y') }}</strong> au <strong>{{ $attestation->date_fin_periode->format('d/m/Y') }}</strong>, soit <strong>{{ $attestation->nombre_jours }} jours</strong>.</p>
            
            <p>Le congé a pris fin le <strong>{{ $attestation->date_fin_conge->format('d/m/Y') }}</strong>.</p>
            
            <p>En foi de quoi, la présente attestation lui est délivrée pour servir et valoir ce que de droit.</p>
        </div>
        
        <div class="signature-section">
            <div class="row">
                <div class="col-md-6">
                    <p>Fait à Porto-Novo, le {{ now()->format('d/m/Y') }}</p>
                </div>
                <div class="col-md-6 text-end">
                    <p><strong>Le Directeur Exécutif</strong></p>
                    <br><br><br>
                    @if($attestation->valide_directeur)
                        <p><strong>Validé le {{ $attestation->date_validation->format('d/m/Y') }}</strong></p>
                        <div class="validation-stamp">
                            <span class="stamp">VALIDÉ</span>
                        </div>
                    @else
                        <p><em>En attente de validation</em></p>
                    @endif
                </div>
            </div>
        </div>
    </div>
    
    <!-- Actions for authorized users -->
    <div class="actions-section no-print">
        @php
            $permission = Auth::user()->permissionrh ?? null;
        @endphp
        
        @if(in_array($permission, ['rh', 'valideur']))
            <div class="row mt-4">
                <div class="col-md-12">
                    @if(!$attestation->valide_directeur)
                        <form action="{{ route('attestations_conge.valider', $attestation->id) }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-success">Valider l'Attestation</button>
                        </form>
                        <form action="{{ route('attestations_conge.rejeter', $attestation->id) }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-warning">Rejeter l'Attestation</button>
                        </form>
                    @endif
                    
                    <a href="{{ route('attestations_conge.edit', $attestation->id) }}" class="btn btn-primary">Modifier</a>
                    
                    <form action="{{ route('attestations_conge.destroy', $attestation->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette attestation ?')">Supprimer</button>
                    </form>
                </div>
            </div>
        @endif
    </div>
</div>

<style>
    .attestation-content {
        background: white;
        padding: 30px;
        margin: 20px 0;
        border: 1px solid #ddd;
        font-family: 'Times New Roman', serif;
        line-height: 1.6;
    }
    
    .header-section {
        margin-bottom: 30px;
    }
    
    .title-section {
        margin: 30px 0;
    }
    
    .title-section h2 {
        font-size: 24px;
        font-weight: bold;
        margin-bottom: 10px;
    }
    
    .content-section {
        margin: 30px 0;
        text-align: justify;
    }
    
    .employee-info {
        margin: 20px 0;
        padding: 15px;
        background-color: #f8f9fa;
        border-left: 4px solid #038C4F;
    }
    
    .signature-section {
        margin-top: 50px;
    }
    
    .validation-stamp {
        margin-top: 20px;
    }
    
    .stamp {
        display: inline-block;
        padding: 10px 20px;
        border: 3px solid #038C4F;
        color: #038C4F;
        font-weight: bold;
        font-size: 16px;
        transform: rotate(-15deg);
    }
    
    .btn-success {
        background-color: #038C4F;
        border-color: #038C4F;
    }
    
    .btn-success:hover {
        background-color: #026838;
        border-color: #026838;
    }
    
    @media print {
        .no-print {
            display: none !important;
        }
        
        .attestation-content {
            border: none;
            box-shadow: none;
            margin: 0;
            padding: 0;
        }
        
        body {
            font-size: 12pt;
        }
        
        .container {
            max-width: none;
            margin: 0;
            padding: 0;
        }
    }
</style>
@endsection