@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Liste des historiques</h1>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Action</th>
                    <th>Document</th>
                    <th>Utilisateur</th>
                    <th>Date de l'action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($histories as $history)
                    <tr>
                        <td>{{ $history->id }}</td>
                        <td>{{ $history->action }}</td>
                        <td>{{ $history->document->nom ?? 'N/A' }}</td> <!-- Nom du document -->
                        <td>{{ $history->user->name ?? 'N/A' }}</td> <!-- Nom de l'utilisateur -->
                        <td>{{ $history->action_date }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
