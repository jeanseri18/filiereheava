@extends('layouts.apprh')

@section('content')
<div class="container">
    <div class="card custom-card">
        <div class="card-body">
            <h3 class="text-2xl font-bold mb-4">Détail de la Demande Spéciale</h3>

            <p><strong>Objet :</strong> {{ $demande_speciale->objet }}</p>
            <p><strong>Employé :</strong> {{ $demande_speciale->user->nom ?? '' }}</p>
            <p><strong>Status :</strong> {{ ucfirst($demande_speciale->status) }}</p>

            <div class="text-center mt-4">
                <a href="{{ route('demandes_speciales.index') }}" class="btn btn-secondary">Retour</a>
            </div>
        </div>
    </div>
</div>
@endsection
