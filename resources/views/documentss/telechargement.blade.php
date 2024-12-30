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
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}
.{height:200dashheight px;}



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
              <img src="lock-large@2x.webp" width="200px">
                </div>
            </div>
        </div>
    </div>
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
