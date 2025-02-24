@extends('layouts.app')

@section('content')
<div class="card custom-card">
    <div class="card-body">
        <div class="container">
            <h2>Détails du document</h2>
            <div class="row">
                <!-- Détails du document -->
                <div class="col-md-6">
                    <ul class="list-group">
                        <li class="list-group-item"><strong>Nom : </strong>{{ $document->nom }}</li>
                        <li class="list-group-item"><strong>Fichier : </strong><a href="{{ Storage::url($document->file_url) }}" target="_blank">Voir le fichier</a></li>
                        <li class="list-group-item"><strong>Type de document : </strong>{{ $document->type_doc }}</li>
                        <li class="list-group-item"><strong>Type de partage : </strong>{{ $document->type_share }}</li>
                        <li class="list-group-item"><strong>Statut : </strong>{{ $document->status }}</li>
                        <li class="list-group-item"><strong>Créé par : </strong>{{ $document->creator->name }}</li>
                    </ul>

                    <a href="{{ route('documents.index') }}" class="btn btn-secondary mt-3">Retour à la liste</a>
                </div>

                <!-- Aperçu du fichier -->
                <div class="col-md-6">
                <div class="card">
    @php
        // Obtenez l'extension du fichier
        $extension = pathinfo(Storage::url($document->file_url), PATHINFO_EXTENSION);
    @endphp

    @if (in_array($extension, ['pdf', 'jpg', 'jpeg', 'png']))
        <!-- Aperçu direct dans un iframe pour PDF et images -->
        <iframe src="{{ Storage::url($document->file_url) }}" width="100%" height="400px" frameborder="0"></iframe>
    @elseif (in_array($extension, ['doc', 'docx', 'xlsx', 'xls']))
        <!-- Lien pour ouvrir le fichier Office -->
        <p>        <iframe src="{{ Storage::url($document->file_url) }}" width="100%" height="400px" frameborder="0"></iframe>

             <a href="{{ Storage::url($document->file_url) }}" target="_blank">Télécharger le fichier</a></p>
    @else
        <!-- Message par défaut pour les types non pris en charge -->
        <p>Prévisualisation non disponible pour ce type de fichier. <a href="{{ Storage::url($document->file_url) }}" target="_blank">Télécharger le fichier</a></p>
    @endif
</div>

                </div>
            </div>
        </div>
    </div>
</div>

<style>
.custom-card {
    border: 2px dashed #038C4F; /* Bordure en traits */
    border-radius: 8px; /* Coins arrondis */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Légère ombre */
    padding: 20px;
    background-color: #f9f9f9;
    transition: transform 0.2s, box-shadow 0.2s;
}

.custom-card:hover {
    transform: translateY(-5px); /* Effet de survol */
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

.form-label {
    font-weight: bold;
    color: #333;
}

.form-control {
    border: 1px solid #ddd;
    border-radius: 5px;
}

.form-control:focus {
    border-color: #038C4F;
    box-shadow: 0 0 5px rgba(3, 140, 79, 0.5);
}
</style>
@endsection
