@extends('layouts.app')

@section('content')
<div class="container ">
    <div class="card shadow-sm">
        <div class="card-header text-black">
            <h1 class="mb-0">Modifier l'Utilisateur</h1>
        </div>
        <div class="card-body">
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('users.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')

                @include('users.form', ['user' => $user])

            </form>
        </div>
    </div>
</div>
@endsection
