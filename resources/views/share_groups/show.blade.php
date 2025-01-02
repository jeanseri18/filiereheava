@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Groupe : {{ $group->nom }}</h1>

    <h3>Membres</h3>
    <ul>
        @foreach($group->members as $member)
        <li>
            {{ $member->name }}
            <form action="{{ route('share_groups.removeMember', [$group->id, $member->id]) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
            </form>
        </li>
        @endforeach
    </ul>

    <h3>Ajouter un Membre</h3>
    <form action="{{ route('share_groups.addMember', $group->id) }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="id_user" class="form-label">Sélectionnez un utilisateur</label>
            <select name="id_user" id="id_user" class="form-control" required>
                @foreach($users as $user)
                <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Ajouter</button>
    </form>
</div>
@endsection
