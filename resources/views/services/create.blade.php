@extends('layouts.app')

@section('content')
<div class="container ">
    <div class="card custom-card shadow-sm">
        <div class="card-header  text-black">
            <h1 class="mb-0">Ajouter une direction</h1>
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

            <form action="{{ route('services.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="nom" class="form-label">Nom de la direction</label>
                    <input type="text" name="nom" id="nom" class="form-control" 
                           placeholder="Entrez le nom de la direction" value="{{ old('nom') }}" required>
              

                <!--div class="mb-3">
                    <label for="id_direction" class="form-label">Direction</label>
                    <select name="id_direction" id="id_direction" class="form-select" required>
                        <option value="" disabled selected>Choisissez une direction</option>
                        @foreach($directions as $direction)
                            <option value="{{ $direction->id }}" 
                                {{ old('id_direction') == $direction->id ? 'selected' : '' }}>
                                {{ $direction->nom }}
                            </option>
                        @endforeach
                    </select-->
                </div>

                <div class="mb-3">
                    <button type="submit" class="btn btn-success">Ajouter</button>
                </div>
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
