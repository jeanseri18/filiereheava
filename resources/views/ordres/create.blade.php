@extends('layouts.apprh')

@section('content')
<div class="container">
    <div class="card custom-card">
        <div class="card-body">
            <h1 class="text-2xl font-bold mb-4">Créer un Ordre de Mission </h1>

            @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('ordres.store') }}" method="POST">
                @csrf
                <div class="form-group mb-3">
                    <label for="user_id">Employé</label>
                    <select name="user_id" id="user_id" class="form-control" required>
                        <option value="">Sélectionner un employé</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}">{{ $user->nom }} - {{ $user->fonction }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- <div class="form-group mb-3">
                    <label for="emploi_occupe">Emploi occupé</label>
                    <input type="text" name="emploi_occupe" id="emploi_occupe" class="form-control" required>
                </div> -->

                <div class="form-group mb-3">
                    <label for="lieu_mission">Lieu de mission</label>
                    <input type="text" name="lieu_mission" id="lieu_mission" class="form-control" required>
                </div>

                <div class="form-group mb-3">
                    <label for="objet_mission">Objet de la mission</label>
                    <textarea name="objet_mission" id="objet_mission" class="form-control" rows="3" required></textarea>
                </div>

                <div class="form-group mb-3">
                    <label for="moyen_transport">Moyen de transport</label>
                    <input type="text" name="moyen_transport" id="moyen_transport" class="form-control" required>
                </div>

                <div class="form-group mb-3">
                    <label for="date_depart">Date de départ</label>
                    <input type="date" name="date_depart" id="date_depart" class="form-control" required>
                </div>

                <div class="form-group mb-3">
                    <label for="date_retour">Date de retour</label>
                    <input type="date" name="date_retour" id="date_retour" class="form-control" required>
                </div>

                <div class="form-group mb-3">
                    <label for="lieu_creation">Lieu de création</label>
                    <input type="text" name="lieu_creation" id="lieu_creation" class="form-control" required>
                </div>

                <div class="form-group mb-3">
                    <label for="date_creation">Date de création</label>
                    <input type="date" name="date_creation" id="date_creation" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-primary">Créer l'Ordre de Mission</button>
            </form>
        </div>
    </div>
</div>
@endsection
