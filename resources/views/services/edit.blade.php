@extends('layouts.app')

@section('content')
<div class="container ">
    <div class="card shadow-sm">
        <div class="card-header  text-black">
            <h1 class="mb-0">Modifier le Service</h1>
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

            <form action="{{ route('services.update', $service) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="nom" class="form-label">Nom du Service</label>
                    <input type="text" name="nom" id="nom" class="form-control" 
                           value="{{ old('nom', $service->nom) }}" placeholder="Entrez le nom du service" required>
                </div>

                <div class="mb-3">
                    <label for="id_direction" class="form-label">Direction</label>
                    <select name="id_direction" id="id_direction" class="form-select" required>
                        <option value="" disabled>Choisissez une direction</option>
                        @foreach($directions as $direction)
                            <option value="{{ $direction->id }}" 
                                {{ old('id_direction', $service->id_direction) == $direction->id ? 'selected' : '' }}>
                                {{ $direction->nom }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <button type="submit" class="btn btn-success text-white">Mettre à jour</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
