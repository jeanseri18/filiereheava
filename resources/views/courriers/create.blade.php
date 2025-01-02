@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Créer un nouveau courrier</h1>

    <form action="{{ route('courriers.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Titre</label>
            <input type="text" name="title" id="title" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="content" class="form-label">Contenu</label>
            <textarea name="content" id="content" class="form-control" rows="5" required></textarea>
        </div>
        <div class="mb-3">
            <label for="sender" class="form-label">Expéditeur</label>
            <input type="text" name="sender" id="sender" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="receiver" class="form-label">Destinataire</label>
            <input type="text" name="receiver" id="receiver" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="attachment" class="form-label">Pièce jointe</label>
            <input type="file" name="attachment" id="attachment" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Envoyer</button>
    </form>
</div>
@endsection
