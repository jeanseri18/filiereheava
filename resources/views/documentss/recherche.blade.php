@extends('layouts.app')

@section('title', 'Recherche')
@push('styles')
<style>
.dashboard-block {
    background-color: #f8f9fa;
    border: 1px solid #ddd;
    border-radius: 8px;
    padding: 20px;
    display: flex;
    align-items: center;
}
.{height:200dashheight px;}

.filter-form {
        background-color: #f8f9fa;
        padding: 20px;
        border-radius: 8px;
    }

    .filter-form .form-group {
        margin-bottom: 15px;
    }
    .filter-form .form-control, 
    .filter-form .form-select {
        background-color: #F2F2F2;
        border: 1px solid #ddd;
        color: #333;
        border-radius: 5px;
        height: calc(1.5em + 0.75rem + 2px);
        padding: 0.375rem 0.75rem;
    }

    .filter-form .form-control:focus, 
    .filter-form .form-select:focus {
        background-color: #F2F2F2;
        border-color: #038C4F; /* Couleur de bordure au focus */
        box-shadow: none;
    }


.dashboard-blocktext {
    font-size: 70px;
    margin-bottom: 0;
    font-weight:bold;
}



</style>
@endpush

@section('content')
<div class="container">
<div class="row g-4 dashboard-block">
        <!-- Bloc Document partagé -->
        <div class="col-md-8">
            <div class="">
                <div>
                    <h1 class="dashboard-blocktext ">Recherche</h1>
                    <p style="font-size:25px;">Retrouvez vos documents partagé et ajouté  en utilisant la barre de recherches.</p>
                </div>
            </div>
        </div>
        
        <!-- Bloc Document validé -->
        <div class="col-md-4">
            <div class="">
                <div>
              <img src="logobg.png" width="200px">
                </div>
            </div>
        </div>
    </div>
    <br><form action="" method="GET" class="filter-form">
        <div class="row g-3">

            <!-- Champ Date de début -->
            <div class="col-md-6">
                <label for="start_date" class="form-label">Date de début</label>
                <input type="date" id="start_date" name="start_date" class="form-control">
            </div>

            <!-- Champ Date de fin -->
            <div class="col-md-6">
                <label for="end_date" class="form-label">Date de fin</label>
                <input type="date" id="end_date" name="end_date" class="form-control">
            </div>
            <!-- Champ Service -->
            <div class="col-md-4">
                <select id="service" name="service" class="form-select">
                    <option value="" selected>Tous les services</option>
                    <option value="service1">Service 1</option>
                    <option value="service2">Service 2</option>
                    <option value="service3">Service 3</option>
                </select>
            </div>

            <!-- Champ Direction -->
            <div class="col-md-4">
                <select id="direction" name="direction" class="form-select">
                    <option value="" selected>Toutes les directions</option>
                    <option value="direction1">Direction 1</option>
                    <option value="direction2">Direction 2</option>
                    <option value="direction3">Direction 3</option>
                </select>
            </div>

            <!-- Champ Visibilité -->
            <div class="col-md-4">
                <select id="visibility" name="visibility" class="form-select">
                    <option value="" selected>Choissir la visibilite</option>
                    <option value="public">Public</option>
                    <option value="private">Privé</option>
                </select>
            </div>


            <!-- Bouton Rechercher -->
            <div class="col-md-4 align-self-end">
                <button type="submit" class="btn  w-100" style="background-color:#412516;color:white;"><i class="bi bi-search"></i> Rechercher</button>
            </div>
                       <div class="col-md-4" ></div>
                       <div class="col-md-4" ></div>
        </div>
    </form>
<br>
    <h2 class="mt-4">Résultats de recherche :</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Nom du Document</th>
                <th>Date</th>
                <th>Statut</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>Plan d'affaires</td>
                <td>2024-11-22</td>
                <td><span class="badge text-bg-success">Actif</span></td>
            </tr>
        </tbody>
    </table>
</div>
@endsection
