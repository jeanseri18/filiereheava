@extends('layouts.app')

@section('title', 'Mes Documents')

@push('styles')
<style>
.dashboard-block {
    background-color: #f8f9fa;
    border: 1px solid #ddd;
    border-radius: 8px;
    padding: 20px;
    display: flex;
    align-items: center;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}
.{height:200dashheight px;}

.filter-form {
        background-color: #f8f9fa;
        padding: 20px;
        border-radius: 8px;
    }

    .filter-form .form-group {
        margin-bottom: 15px;
    }
    .filter-form .form-control, 
    .filter-form .form-select {
        background-color: #F2F2F2;
        border: 1px solid #ddd;
        color: #333;
        border-radius: 5px;
        height: calc(1.5em + 0.75rem + 2px);
        padding: 0.375rem 0.75rem;
    }

    .filter-form .form-control:focus, 
    .filter-form .form-select:focus {
        background-color: #F2F2F2;
        border-color: #038C4F; /* Couleur de bordure au focus */
        box-shadow: none;
    }


.dashboard-blocktext {
    font-size: 70px;
    margin-bottom: 0;
    font-weight:bold;
}




    .upload-box {
        border: 2px dashed #038C4F;
        border-radius: 8px;
        padding: 20px;
        text-align: center;
        background-color: #f8f9fa;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .upload-box:hover {
        background-color: #e9f7ef;
    }

    .upload-box p {
        margin: 0;
        font-size: 18px;
        color: #6c757d;
    }

    .upload-box input[type="file"] {
        display: none;
    }

    .table th, .table td {
        vertical-align: middle;
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
</style>
@endpush

@section('content')
<div class="container">
<div class="row g-4 dashboard-block">
        <!-- Bloc Document partagé -->
        <div class="col-md-8">
            <div class="">
                <div>
                    <h1 class="dashboard-blocktext ">verification</h1>
                    <p style="font-size:25px;">Retrouvez vos documents partagé et ajouté  en utilisant la barre de recherches.</p>
                </div>
            </div>
        </div>
        
        <!-- Bloc Document validé -->
        <div class="col-md-4">
            <div class="">
                <div>
              <img src="lock-large@2x.webp" width="200px">
                </div>
            </div>
        </div>
    </div><br>
    <!-- Zone de téléchargement -->
    <div class="mb-4">
        <div class="upload-box" onclick="document.getElementById('file-upload').click();">
            <input type="file" id="file-upload" multiple>
            <p><i class="bi bi-cloud-upload" style="font-size: 2rem; color: #038C4F;"></i></p>
            <p>Glissez vos fichiers ici ou cliquez pour les sélectionner</p>
        </div>
    </div>

    <!-- Tableau des documents -->
   </div>
@endsection

@push('scripts')
<script>
    // Gestion de l'upload des fichiers
    document.getElementById('file-upload').addEventListener('change', function (e) {
        const files = e.target.files;
        console.log('Fichiers sélectionnés :', files);
        alert(`${files.length} fichier(s) sélectionné(s).`);
    });
</script>
@endpush
