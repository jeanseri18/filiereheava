@extends('layouts.app')

@section('title', 'Documents Partagés')

@section('content')
<div class="container">
    <h1>Documents Partagés</h1>
    <p>Liste des documents partagés :</p>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Nom du Document</th>
                <th>Date de Partage</th>
                <th>Partagé avec</th>
                <th>Statut</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>Contrat 2023</td>
                <td>2024-11-27</td>
                <td>John Doe</td>
                <td><span class="badge text-bg-success">Actif</span></td>
            </tr>
            <tr>
                <td>2</td>
                <td>Présentation Projet</td>
                <td>2024-11-25</td>
                <td>Jane Smith</td>
                <td><span class="badge text-bg-warning">En Attente</span></td>
            </tr>
        </tbody>
    </table>
</div>
@endsection
