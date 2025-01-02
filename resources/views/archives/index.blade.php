@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="my-4">Liste des documents archivés</h1>

    <!-- Formulaire de recherche -->
    <form method="GET" action="{{ route('archives.index') }}" class="mb-4">
        <div class="row g-3">
            <div class="col-md-3">
                <input type="text" name="nom" class="form-control" placeholder="Nom du document" value="{{ request('nom') }}">
            </div>
            <!--div class="col-md-3">
                <select name="type_doc" class="form-select">
                    <option value="">-- Type de document --</option>
                    @foreach($typesDoc as $type)
                        <option value="{{ $type }}" {{ request('type_doc') == $type ? 'selected' : '' }}>
                            {{ ucfirst($type) }}
                        </option>
                    @endforeach
                </select>
            </div-->
            <div class="col-md-3">
                <select name="type_share" class="form-select">
                    <option value="">-- Type de partage --</option>
                    @foreach($typesShare as $share)
                        <option value="{{ $share }}" {{ request('type_share') == $share ? 'selected' : '' }}>
                            {{ ucfirst($share) }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <select name="status" class="form-select">
                    <option value="">-- Statut --</option>
                    @foreach($statuses as $status)
                        <option value="{{ $status }}" {{ request('status') == $status ? 'selected' : '' }}>
                            {{ ucfirst($status) }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="row g-3 mt-3">
            <div class="col-md-12 text-start">
                <button type="submit" class="btn btn-primary">Rechercher</button>
                <a href="{{ route('archives.index') }}" class="btn btn-secondary">Réinitialiser</a>
            </div>
        </div>
    </form>

    <!-- Table des résultats -->
    @if($documents->count())
        <table id ="Table" class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nom</th>
                    <th>Type</th>
                    <th>Partage</th>
                    <th>Statut</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($documents as $document)
                    <tr>
                        <td>{{ $document->id }}</td>
                        <td>{{ $document->nom }}</td>
                        <td>{{ $document->type_doc }}</td>
                        <td>{{ $document->type_share }}</td>
                        <td><span class="badge bg-info">{{ ucfirst($document->status) }}</span></td>
                        <td>
                            <a href="{{ route('archives.download', $document) }}" class="btn btn-success btn-sm">Télécharger</a>
                            @if($document->status === 'archivé')
                                <a href="{{ route('archives.unarchive', $document) }}" class="btn btn-warning btn-sm">Désarchiver</a>
                            @else
                                <form method="POST" action="{{ route('archives.archive', $document) }}" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-sm">Archiver</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $documents->links() }}
    @else
        <p>Aucun document trouvé avec ces critères.</p>
    @endif
</div>
@endsection
