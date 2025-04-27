@extends('layouts.app')

@section('content')
<div class="card custom-card ">
<div class="card-body">

<div class="row">

<div class="col-md-7" style="padding-left:10px">
<i class="bi bi-journal-minus" style="font-size:50px;color:#038C4F;"></i>

    <h1>{{ $courrier->title }}</h1>
    <p><strong>Type :</strong> {{ $courrier->type }}</p>
    <p><strong>Contenu :</strong></p>
    <p>{{ $courrier->content }}</p>

    @if($courrier->attachment)
    <p><strong>Pièce jointe :</strong></p>
    <a href="{{ asset('storage/' . $courrier->attachment) }}" class="btn btn-success" download>Télécharger</a>
    @endif
</div></div>

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
