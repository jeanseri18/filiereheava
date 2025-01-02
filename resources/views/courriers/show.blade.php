@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $courrier->title }}</h1>
    <p><strong>Expéditeur :</strong> {{ $courrier->sender }}</p>
    <p><strong>Destinataire :</strong> {{ $courrier->receiver }}</p>
    <p><strong>Contenu :</strong></p>
    <p>{{ $courrier->content }}</p>

    @if($courrier->attachment)
    <p><strong>Pièce jointe :</strong></p>
    <a href="{{ asset('storage/' . $courrier->attachment) }}" class="btn btn-secondary" download>Télécharger</a>
    @endif
</div>
@endsection
