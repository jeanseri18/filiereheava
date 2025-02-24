@extends('layouts.app')

@section('content')
<div class="container">
    <!-- Section Titre -->
    <div class="alert alert-success">
        <h1>{{ $group->nom }}</h1>
        <p>Gestion des membres du groupe</p>
    </div>

    <!-- Formulaire d'ajout de membres -->
    <form action="{{ route('share_groups.addMember', $group->id) }}" method="POST" class="mb-4">
        @csrf
        <div class="row">
            <div class="col-md-8">
                <div class="mb-3">
                    <select name="id_user" id="id_user" class="form-control" required>
                        <option value="" disabled selected>Sélectionnez un utilisateur</option>
                        @foreach($users as $user)
                        <option value="{{ $user->id }}">{{ $user->nom }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <button type="submit" class="btn btn-success w-100">
                    <i class="bi bi-plus-circle me-2"></i>Ajouter un membre
                </button>
            </div>
        </div>
    </form>

    <!-- Liste des membres -->
    <h4 class="mb-3">Liste des membres</h4>
    <div class="row">
        @foreach($group->members as $member)
        <div class="col-md-3">
            <div class="card custom-card text-center mb-3">
                <div class="card-body">
                @if(Auth::user()->file_url)
            <img src="{{ asset('storage/' . Auth::user()->file_url) }}" 
                 alt="Photo de profil" 
                 class="rounded-circle" 
                 style="width: 150px; height: 150px; object-fit: cover;">
        @else
            <!-- Si aucune photo n'est définie, une photo par défaut -->
            <i class="bi bi-person-circle " class="rounded-circle" 

                 style="font-size: 120px;color:green"></i>
        @endif                    <h5 class="mt-3">{{ $member->nom }}</h5>
        @if(auth()->user()->id==$member->id ||$group->creator->id==auth()->user()->id  )
                    <form action="{{ route('share_groups.removeMember', [$group->id, $member->id]) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">
                            <i class="bi bi-trash3"></i>
                        </button>
                    </form>@else
                    <a href="#" class="btn btn-secondary btn-sm " readonly>
                            <i class="bi bi-trash3"></i>
</a>
                    @endif
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

<!-- Styles personnalisés -->
<style>
    .custom-card {
        border: 2px dashed #6c757d; /* Bordure en traits avec espaces */
        border-radius: 8px; /* Coins arrondis */
        transition: transform 0.2s, box-shadow 0.2s;
    }

    .custom-card:hover {
        transform: translateY(-5px); /* Animation au survol */
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }
</style>
@endsection
