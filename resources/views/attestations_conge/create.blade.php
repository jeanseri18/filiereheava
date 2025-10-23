@extends('layouts.apprh')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Créer une Attestation de Congé</h1>
        </div>
    </div>
    <br>
    
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card custom-card">
        <div class="card-body">
            <form action="{{ route('attestations_conge.store') }}" method="POST">
                @csrf
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="demande_conge_id" class="form-label">Demande de Congé <span class="text-danger">*</span></label>
                            <select class="form-select" id="demande_conge_id" name="demande_conge_id" required>
                                <option value="">Sélectionner une demande de congé</option>
                                @foreach($demandes as $demande)
                                    <option value="{{ $demande->id }}" {{ old('demande_conge_id') == $demande->id ? 'selected' : '' }}>
                                        {{ $demande->user->nom }} {{ $demande->user->prenom }} - 
                                        Du {{ $demande->date_debut->format('d/m/Y') }} au {{ $demande->date_fin->format('d/m/Y') }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="date_fin_conge" class="form-label">Date de Fin du Congé <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" id="date_fin_conge" name="date_fin_conge" value="{{ old('date_fin_conge') }}" required>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="date_debut_periode" class="form-label">Date de Début de la Période Accordée <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" id="date_debut_periode" name="date_debut_periode" value="{{ old('date_debut_periode') }}" required>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="date_fin_periode" class="form-label">Date de Fin de la Période Accordée <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" id="date_fin_periode" name="date_fin_periode" value="{{ old('date_fin_periode') }}" required>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="annee" class="form-label">Année N <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" id="annee" name="annee" value="{{ old('annee', date('Y')) }}" min="2020" max="2030" required>
                        </div>
                    </div>
                </div>
                
                <div class="d-flex justify-content-between">
                    <a href="{{ route('attestations_conge.index') }}" class="btn btn-secondary">Retour</a>
                    <button type="submit" class="btn btn-success">Créer l'Attestation</button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    .custom-card {
        border: 2px dashed #038C4F;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        transition: transform 0.2s, box-shadow 0.2s;
    }

    .custom-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
    }

    .btn-success {
        background-color: #038C4F;
        border-color: #038C4F;
    }

    .btn-success:hover {
        background-color: #026838;
        border-color: #026838;
    }

    .text-danger {
        color: #dc3545 !important;
    }
</style>
@endsection