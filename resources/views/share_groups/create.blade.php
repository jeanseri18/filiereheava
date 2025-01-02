@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Créer un Groupe</h1>
    <form action="{{ route('share_groups.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="nom" class="form-label">Nom du Groupe</label>
            <input type="text" name="nom" id="nom" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Créer</button>
    </form>
</div>
@endsection
