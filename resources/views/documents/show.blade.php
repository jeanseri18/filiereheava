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
                        <li class="list-group-item"><strong>Fichier : </strong><a href="{{ asset('storage/' . $document->file_url) }}" download target="_blank">Voir le fichier</a></li>
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
                            $extension = pathinfo(Storage::url($document->file_url), PATHINFO_EXTENSION);
                        @endphp

                        @if (in_array($extension, ['pdf', 'jpg', 'jpeg', 'png']))
                            <iframe src="{{ asset('storage/'.$document->file_url) }}" width="100%" height="400px" frameborder="0"></iframe>
                        @elseif (in_array($extension, ['doc', 'docx', 'xlsx', 'xls']))
                            <p>
                                <iframe src="{{ asset('storage/'.$document->file_url) }}" width="100%" height="400px" frameborder="0"></iframe>
                                <a href="{{ asset('storage/'.$document->file_url) }}" target="_blank">Télécharger le fichier</a>
                            </p>
                        @else
                            <p>Prévisualisation non disponible pour ce type de fichier. <a href="{{ asset('storage/' .$document->file_url) }}" target="_blank">Télécharger le fichier</a></p>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Affichage des utilisateurs et groupes avec lesquels le fichier est partagé -->
            <div class="row mt-4">
                <div class="col-md-12">
                    <h3>Partagé avec :</h3>

                    @if ($document->type_share == 'privé')
                        <h6>Utilisateurs</h6>
                        <ul class="list-group">
                            @foreach ($users as $user)
                                <li class="list-group-item">{{ $user->nom }}</li>
                            @endforeach
                        </ul>
                    @elseif ($document->type_share == 'groupe')
                        <h6>Groupes</h6>
                        <ul class="list-group">
                            @foreach ($groups as $group)
                                <li class="list-group-item">{{ $group->nom }}</li>
                            @endforeach
                        </ul>
                    @else
                        <p>Aucune information de partage disponible.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.custom-card {
    border: 2px dashed #038C4F;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    padding: 20px;
    background-color: #f9f9f9;
    transition: transform 0.2s, box-shadow 0.2s;
}

.custom-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
}
</style>
@endsection
