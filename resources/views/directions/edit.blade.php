@extends('layouts.app')

@section('content')
<div class="container ">
    <div class="card shadow-sm">
        <div class="card-header  text-black">
            <h2 class="mb-0">Modifier la Direction</h2>
        </div>
        <div class="card-body">
            <form action="{{ route('directions.update', $direction->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="nom" class="form-label">Nom de la Direction</label>
                    <input type="text" name="nom" id="nom" class="form-control" value="{{ $direction->nom }}" placeholder="Entrez le nom de la direction" required>
                </div>

                <div class="mb-3">
                    <label for="status" class="form-label">Statut</label>
                    <select name="status" id="status" class="form-select" required>
                        <option value="actif" {{ $direction->status == 'actif' ? 'selected' : '' }}>Actif</option>
                        <option value="inactif" {{ $direction->status == 'inactif' ? 'selected' : '' }}>Inactif</option>
                    </select>
                </div>

                <div>
                    <button type="submit" class="btn btn-success">Mettre à jour</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
