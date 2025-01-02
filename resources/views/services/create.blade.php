@extends('layouts.app')

@section('content')
<div class="container ">
    <div class="card shadow-sm">
        <div class="card-header  text-black">
            <h1 class="mb-0">Ajouter une direction</h1>
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

            <form action="{{ route('services.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="nom" class="form-label">Nom de la direction</label>
                    <input type="text" name="nom" id="nom" class="form-control" 
                           placeholder="Entrez le nom de la direction" value="{{ old('nom') }}" required>
                </div>

                <!--div class="mb-3">
                    <label for="id_direction" class="form-label">Direction</label>
                    <select name="id_direction" id="id_direction" class="form-select" required>
                        <option value="" disabled selected>Choisissez une direction</option>
                        @foreach($directions as $direction)
                            <option value="{{ $direction->id }}" 
                                {{ old('id_direction') == $direction->id ? 'selected' : '' }}>
                                {{ $direction->nom }}
                            </option>
                        @endforeach
                    </select-->
                </div>

                <div>
                    <button type="submit" class="btn btn-success">Ajouter</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
