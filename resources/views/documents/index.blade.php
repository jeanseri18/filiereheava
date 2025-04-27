@extends('layouts.app')

@section('title', 'Mes Documents')

@push('styles')
<style>
    .upload-box {
        border: 2px solid #038C4F;
        border-radius: 8px;
        padding: 20px;
        text-align: center;
        background-color: #038C4F;height: 200px;
        color: white;
        cursor: pointer;
        transition: background-color 0.3s ease, transform 0.3s ease;
    }

    .upload-box:hover {
        background-color: #01C96F;
        transform: scale(1.05);
    }

    .upload-box p {
        margin: 0;
        font-size: 18px;
        color: white;
    }

    .upload-box input[type="file"] {
        display: none;
    }

    .badge-status {
        padding: 5px 10px;
        border-radius: 12px;
        font-size: 12px;
    }

    .badge-success {
        background-color: #28a745;
        color: white;
    }

    .badge-danger {
        background-color: #dc3545;
        color: white;
    }

    .badge-warning {
        background-color: #ffc107;
        color: black;
    }

    .badge-info {
        background-color: #17a2b8;
        color: white;
    }

    .badge-secondary {
        background-color: #6c757d;
        color: white;
    }

    .card-container {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 20px;
    }

   


    .card-body {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .card-actions a {
        margin-right: 10px;
        color: #038C4F;
        transition: color 0.3s ease;
    }

    .card-actions a:hover {
        color: #01C96F;
    }

    .card-title {
        font-size: 1.25rem;
        color: #038C4F;
    }

    .card-text {
        font-size: 0.875rem;
        color: #6c757d;
    }

    .btn {
        transition: background-color 0.3s ease, transform 0.3s ease;
    }

    .btn:hover {
        transform: scale(1.05);
    }
</style>
@endpush

@section('content')
<div class=" p-4   sw-100">
   

    <!-- Titre et bouton d'ajout -->
    <div class="d-flex justify-content-between align-items-center my-3">
    <h4 class="text-success d-flex align-items-center">
        <i class="bi bi-folder-symlink-fill me-2"></i> Liste des Documents
    </h4>
       
    </div>

    <!-- Barre de recherche -->
    <form method="GET" action="{{ url()->current() }}" class="mb-0">
        
            <input type="text" name="search" class="form-control rounded-pill px-3"
                   placeholder="🔎 Rechercher un document..." value="{{ request('search') }}" style="height: 40px;">
           <br>
           <div class="input-group">
            <button type="submit" class="btn btn-dark btn-sm rounded-pill px-4 me-2" style="height: 40px;">Rechercher</button>
            <a href="{{ route('documents.create') }}" class="btn rounded-pill btn-success btn-sm d-flex align-items-center" style="height: 40px;">
            <i class="bi bi-cloud-upload-fill me-2" style="font-size: 1.5rem;"></i> Ajouter un document
        </a>
        </div>
    </form>

    <!-- Filtres -->
    
</div>


    <div class="container bg-light">
    <br>
    <br>
    <h5 class="mb-3 text-success"><i class="bi bi-funnel"></i> Filtres</h5>
    <div class="btn-group flex-wrap mb-3">
        <a href="{{ route('archives.index') }}" class="btn btn-primary rounded-pill me-2 mb-2"> Tous</a>
        <a href="{{ route('documents.added') }}" class="btn btn-warning rounded-pill me-2 mb-2"> Ajoutés</a>
        <a href="{{ route('documents.pending') }}" class="btn btn-secondary rounded-pill me-2 mb-2"> En Attente</a>
        <a href="{{ route('documents.submitted') }}" class="btn btn-info rounded-pill me-2 mb-2"> Soumis</a>
        <a href="{{ route('documents.validated') }}" class="btn btn-success rounded-pill me-2 mb-2"> Validés</a>
        <a href="{{ route('documents.rejected') }}" class="btn btn-danger rounded-pill me-2 mb-2"> Rejetés</a>
        <a href="{{ route('documents.sharedWithMe') }}" class="btn btn-secondary rounded-pill me-2 mb-2"> Partagés avec moi</a>
        <a href="{{ route('documents.sharedByMe') }}" class="btn btn-info rounded-pill me-2 mb-2"> Partagés par moi</a>
    </div>
        <!-- Zone de téléchargement -->
        
        
        <!-- Message de succès -->
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="card-container">
            @foreach($documents as $document)
                <div class="card">
                    <div class="card-body custom-card">
                        <div class="card-actions">
                            <a href="{{ route('documents.show', $document->id) }}" class="btn btn-sm text-white">
                                <i class="bi bi-eye" style="color: gray; font-size: 20px;"></i>
                            </a>
                            <a href="{{ route('documents.edit', $document->id) }}" class="btn btn-sm text-white">
                                <i class="bi bi-pencil" style="color: black; font-size: 20px;"></i>
                            </a>
                            <a href="{{ asset('storage/' . $document->file_url) }}" class="btn btn-sm text-white" download target="blank">
                                <i class="bi bi-download" style="color: black; font-size: 20px;"></i>
                            </a>
                            <form action="{{ route('documents.destroy', $document->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm text-white" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce document ?')">
                                    <i class="bi bi-trash" style="color: red; font-size: 20px;"></i>
                                </button>
                            </form>
                        </div>
                        <div class="text-center">
                            @switch($document->type_doc)
                                @case('document')
                                    <i class="bi bi-file-earmark card-img-top" style="font-size: 110px; color: #038C4F;"></i>
                                    @break
                                @case('image')
                                    <i class="bi bi-file-earmark-image card-img-top" style="font-size: 110px; color: #038C4F;"></i>
                                    @break
                                @case('tableaux')
                                    <i class="bi bi-file-earmark-spreadsheet card-img-top" style="font-size: 110px; color: #038C4F;"></i>
                                    @break
                                @case('video')
                                    <i class="bi bi-file-earmark-play card-img-top" style="font-size: 110px; color: #038C4F;"></i>
                                    @break
                                @case('pdf')
                                    <i class="bi bi-file-earmark-pdf card-img-top" style="font-size: 110px; color: #038C4F;"></i>
                                    @break
                                @default
                                    <i class="bi bi-file-earmark card-img-top" style="font-size: 110px; color: #038C4F;"></i>
                            @endswitch
                        </div>
                        <br>
                        <h3 class="card-title"><strong>{{ $document->nom ?? $document->document->nom }}</strong></h3>
                        <p class="card-text" style="font-size: 13px">Type de partage: {{ $document->type_share }}
                            <br>Ajouté le : {{ $document->created_at }}
                            <br> Par : {{ optional($document->creator)->nom ?? 'Moi' }}
                        </p>
                        <p class="card-text">
                            <span class="badge-status @if($document->status ?? $document->document->status == 'validé') badge-success
                                @elseif($document->status ?? $document->document->status == 'rejeté') badge-danger
                                @elseif($document->status ?? $document->document->status == 'en attente') badge-secondary
                                @elseif($document->status ?? $document->document->status == 'ajouté') badge-warning
                                @elseif($document->status ?? $document->document->status == 'soumis') badge-info
                                @else badge-secondary @endif">{{ $document->status ?? $document->document->status }}</span>
                        </p>
                        <hr/>
                        <div class="row">
                            @if($document->status == 'ajouté')
                                <div class="col-md-4">
                                    <form action="{{ route('documents.updateStatus', $document->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        <button type="submit" name="status" value="en attente" class="btn btn-secondary attente">
                                            Soumettre
                                        </button>
                                    </form>
                                </div>
                            @endif
                            @if(auth()->user()->role==='manager' && $document->status == 'en attente')
                                <div class="col-md-4">
                                    <form action="{{ route('documents.updateStatus', $document->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        <button type="submit" name="status" value="soumis" class="btn btn-success soumis">
                                            Valider
                                        </button>
                                    </form>
                                </div>
                                <div class="col-md-4">
                                    <form action="{{ route('documents.updateStatus', $document->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        <button type="submit" name="status" value="rejeté" class="btn btn-danger rejete">
                                            Rejeter
                                        </button>
                                    </form>
                                </div>
                            @endif
                            @if(auth()->user()->role==='admin' && $document->status == 'soumis')
                                <div class="col-md-4">
                                    <form action="{{ route('documents.updateStatus', $document->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        <button type="submit" name="status" value="validé" class="btn btn-success valide">
                                            Valider
                                        </button>
                                    </form>
                                </div>
                                <div class="col-md-4">
                                    <form action="{{ route('documents.updateStatus', $document->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        <button type="submit" name="status" value="rejeté" class="btn btn-danger rejete">
                                            Rejeter
                                        </button>
                                    </form>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-center">
            {!! $documents->links() !!}
        </div>
    </div>
@endsection

@push('styles')
<style>


    .custom-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
    }
</style>

<link href="https://cdn.datatables.net/v/bs5/jq-3.7.0/jszip-3.10.1/dt-2.1.8/b-3.2.0/b-colvis-3.2.0/b-html5-3.2.0/b-print-3.2.0/r-3.0.3/datatables.min.css" rel="stylesheet">
@endpush

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/v/bs5/jq-3.7.0/jszip-3.10.1/dt-2.1.8/b-3.2.0/b-colvis-3.2.0/b-html5-3.2.0/b-print-3.2.0/r-3.0.3/datatables.min.js"></script>
@endpush
