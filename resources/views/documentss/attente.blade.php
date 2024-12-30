@extends('layouts.app')

@section('title', 'Documents en Attente')

@section('content')
<div class="container">
    <h1>Documents en Attente</h1>
    <p>Documents en attente de validation :</p>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Nom du Document</th>
                <th>Date de Soumission</th>
                <th>Soumis par</th>
                <th>Statut</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>Plan Marketing</td>
                <td>2024-11-24</td>
                <td>Jane Doe</td>
                <td><span class="badge text-bg-warning">En Attente</span></td>
            </tr>
        </tbody>
    </table>
</div>
@endsection
