@extends('layouts.app')

@section('content')
<div class="container ">
    <div class="card shadow-sm">
        <div class="card-header  text-blacck">
            <h2 class="mb-0">Créer un nouveau document</h2>
        </div>
        <div class="card-body">
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('documents.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label for="nom" class="form-label">Nom du document</label>
                    <input type="text" name="nom" id="nom" class="form-control" placeholder="Entrez le nom du document" required>
                </div>

                <div class="mb-3">
                    <label for="file_url" class="form-label">Fichier</label>
                    <input type="text" name="file_url" id="file_url" class="form-control" placeholder="Entrez l'URL du fichier" required>
                </div>

                <div class="mb-3">
                    <label for="type_doc" class="form-label">Type de document</label>
                    <select name="type_doc" id="type_doc" class="form-select" required>
                        <option value="document">Document</option>
                        <option value="courrier entrant">Courrier entrant</option>
                        <option value="courrier sortant">Courrier sortant</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="type_share" class="form-label">Type de partage</label>
                    <select name="type_share" id="type_share" class="form-select" required>
                        <option value="public">Public</option>
                        <option value="privé">Privé</option>
                        <option value="groupe">Groupe</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="status" class="form-label">Statut</label>
                    <select name="status" id="status" class="form-select" required>
                        <option value="en attente">En attente</option>
                        <option value="validé">Validé</option>
                        <option value="rejeté">Rejeté</option>
                        <option value="archivé">Archivé</option>
                    </select>
                </div>

                <div>
                    <button type="submit" class="btn btn-success">Créer</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
