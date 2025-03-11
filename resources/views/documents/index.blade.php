@extends('layouts.app')

@section('title', 'Mes Documents')

@push('styles')
<style>
    .upload-box {
        border: 2px solid #038C4F;
        border-radius: 8px;
        padding: 20px;
        text-align: center;
        background-color: #038C4F;
        color:white;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .upload-box:hover {
        background-color: #01C96FFF;
    }

    .upload-box p {
        margin: 0;
        font-size: 18px;
        color: #6c757d;
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
        background-color: #5A5C5CFF;
        color: white;
    }
    .card-container {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
        gap: 20px;
    }

    .card {
        border: 1px solid #ddd;
        border-radius: 8px;
        padding: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .card-body {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .card-actions a {
        margin-right: 10px;
    }
</style>
@endpush

@section('content')
    <div class="container">
        <!-- Zone de téléchargement -->
        <a href="{{ route('documents.create') }}" class="mb-3">
            <div class="mb-4">
                <div class="upload-box">
                    <p><i class="bi bi-cloud-upload" style="font-size: 2rem;     color:white;;"></i></p>
                    <p style="     color:white;">Ajouter un document</p>
                </div>
            </div>
        </a>

        <br>
        <form method="GET" action="{{ url()->current() }}" class="mb-3">
    <div class="input-group">
        <input type="text" name="search" class="form-control" placeholder="Rechercher un document..." value="{{ request('search') }}">
        <button type="submit" class="btn btn-primary">Rechercher</button>
    </div>
</form>


        <h1>Liste des Documents</h1>
        <h5>Filtre</h5>
        <div class="mb-3">

            <a href="{{ route('archives.index') }}" class="btn btn-primary btn-sm">Tous les documents</a>
            <a href="{{ route('documents.added') }}" class="btn btn-warning btn-sm">Ajoutés</a>
            <a href="{{ route('documents.pending') }}" class="btn btn-secondary btn-sm">En Attente</a>
            <a href="{{ route('documents.submitted') }}" class="btn btn-info btn-sm">Soumis</a>
            <a href="{{ route('documents.validated') }}" class="btn btn-success btn-sm">Validés</a>
            <a href="{{ route('documents.rejected') }}" class="btn btn-danger btn-sm">Rejetés</a>
            <a href="{{ route('documents.sharedWithMe') }}" class="btn btn-secondary btn-sm">Partagés avec moi</a>
            <a href="{{ route('documents.sharedByMe') }}" class="btn btn-info btn-sm">Partagés par moi</a>
        </div>

        <!-- Message de succès -->
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="card-container ">
            @foreach($documents as $document)
                <div class="card ">
                    <div class="card-body custom-card">
                    <div class="card-actions">
                            <a href="{{ route('documents.show', $document->id) }}"class="btn  btn-sm text-white" >
                                <i class="bi bi-eye"  style="color:gray;font-size:20px;" ></i> 
                            </a>
                            <a href="{{ route('documents.edit', $document->id) }}"  class="btn  btn-sm text-white" >
                                <i class="bi bi-pencil" style="color:black;font-size:20px;"></i>
                            </a>
                            <a href="{{ asset('storage/' . $document->file_url) }}"class="btn  btn-sm text-white" download target="blank">

                            <i class="bi bi-download"  style="color:black;font-size:20px;"></i>        </a>
                         
                            <form action="{{ route('documents.destroy', $document->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm text-white"  onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce document ?')">
                                    <i class="bi bi-trash" style="color:red;font-size:20px;"></i>
                                </button>
                            </form>
                        </div>
                        <div class="text-center">
                    @switch($document->type_doc)
                                @case('document')
                                    <i class="bi bi-file-earmark   card-img-top" style="font-size:110px;color:#038C4F;"></i> 
                                    @break
                                @case('image')
                                    <i class="bi bi-file-earmark-image   card-img-top" style="font-size:110px;color:#038C4F;"></i> 
                                    @break
                                @case('tableaux')
                                    <i class="bi bi-file-earmark-spreadsheet   card-img-top" style="font-size:110px;color:#038C4F;"></i> 
                                    @break
                                @case('video')
                                    <i class="bi bi-file-earmark-play   card-img-top" style="font-size:110px;color:#038C4F;"></i> 
                                    @break
                                @case('pdf')
                                    <i class="bi bi-file-earmark-pdf   card-img-top" style="font-size:110px;color:#038C4F;"></i> 
                                    @break
                                @default
                                    <i class="bi bi-file-earmark   card-img-top" style="font-size:110px;color:#038C4F;"></i> 
                            @endswitch
</div>
                       
                        
                    </div><br>
                    <h3 class="card-title"><strong>{{ $document->nom ?? $document->document->nom }}</strong></h3>
                        <p class="card-text" style="font-size:13px">Type de partage: {{ $document->type_share }}
                        <br>Ajouté le : {{ $document->created_at }}
                        <br> Par : {{ optional($document->creator)->nom ?? 'Moi' }}
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
            <button type="submit" name="status" value="rejeté" class="btn  btn-danger rejete">
                 Rejeter
            </button>
        </form>
    </div>@endif
    
    @if(auth()->user()->role==='admin' && $document->status == 'soumis' ) 

    <div class="col-md-4">
        <form action="{{ route('documents.updateStatus', $document->id) }}" method="POST" style="display: inline;">
            @csrf
            <button type="submit" name="status" value="validé" class="btn  btn-success valide">
                 Valider
            </button>
        </form>
    </div>
    <div class="col-md-4">
        <form action="{{ route('documents.updateStatus', $document->id) }}" method="POST" style="display: inline;">
            @csrf
            <button type="submit" name="status" value="rejeté" class="btn  btn-danger rejete">
                 Rejeter
            </button>
        </form>
    </div>@endif
   
</div>               </div>
                
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
    .custom-card {
        border: 2px dashed #038C4F; /* Bordure en traits */
        border-radius: 8px; /* Coins arrondis */
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Légère ombre */
        padding: 20px;
        background-color: #f9f9f9;
        transition: transform 0.2s, box-shadow 0.2s;
    }

    .custom-card:hover {
        transform: translateY(-5px); /* Effet de survol */
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
