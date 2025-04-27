@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card custom-card">
        <div class="card-body">
            <h1 class="mb-4">Créer un nouveau courrier</h1>

            <!-- Affichage des erreurs de validation -->
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('courriers.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="title" class="form-label">Titre</label>
                    <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}" required>
                </div>
                <div class="mb-3">
                    <label for="content" class="form-label">Contenu</label>
                    <textarea name="content" id="content" class="form-control" rows="5" required>{{ old('content') }}</textarea>
                </div>
             
                <div class="mb-3">
                    <label for="receiver" class="form-label">Type </label>
<select name="type" class="form-control">
    <option value="Courrier entrant">Courrier entrant</option>
    <option value="Courrier sortant">Courrier sortant</option>
</select>                </div>
                <div class="mb-3">
                    <label for="attachment" class="form-label">Pièce jointe</label>
                    <input type="file" name="attachment" id="attachment" class="form-control">
                </div>
                <button type="submit" class="btn btn-success"> <i class="bi bi-check-circle me-2"></i>Enregistrer</button>
            </form>
        </div>
    </div>
</div>

<!-- Styles personnalisés -->
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
