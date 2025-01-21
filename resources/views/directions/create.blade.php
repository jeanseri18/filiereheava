@extends('layouts.app')

@section('content')
<div class="container ">
    <div class="card shadow-sm">
        <div class="card-header  text-BLACK">
            <h2 class="mb-0">Ajouter une Direction</h2>
        </div>
        <div class="card-body">
            <form action="{{ route('directions.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="nom" class="form-label">Nom de la Direction</label>
                    <input type="text" name="nom" id="nom" class="form-control" placeholder="Entrez le nom de la direction" required>
                </div>

                <div class="mb-3">
                    <label for="status" class="form-label">Statut</label>
                    <select name="status" id="status" class="form-select" required>
                        <option value="" disabled selected>Choisir un statut</option>
                        <option value="actif">Actif</option>
                        <option value="inactif">Inactif</option>
                    </select>
                </div>

                <div class="mb-3">
                    <button type="submit" class="btn btn-success">Enregistrer</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
