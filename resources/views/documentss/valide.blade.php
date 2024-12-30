@extends('layouts.app')

@section('title', 'Documents Validés')

@section('content')
<div class="container">
    <h1>Documents Validés</h1>
    <p>Liste des documents validés et signés :</p>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Nom du Document</th>
                <th>Date de Validation</th>
                <th>Signé par</th>
                <th>Statut</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>Rapport Annuel</td>
                <td>2024-11-26</td>
                <td>Alexander Pierce</td>
                <td><span class="badge text-bg-success">Validé</span></td>
            </tr>
        </tbody>
    </table>
</div>
@endsection
