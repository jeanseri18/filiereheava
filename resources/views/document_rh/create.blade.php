@extends('layouts.apprh')

@section('content')
<div class="container">
    <div class="card custom-card">
        <div class="card-body">
            <h2>Ajouter un Document RH</h2>
            
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('document_rh.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label for="categorie">Catégorie</label>
                    <select name="categorie_id" id="categorie" class="form-control">
                        <option value="">Sélectionner une catégorie</option>
                        @foreach($categories as $categorie)
                            <option value="{{ $categorie->id }}">{{ $categorie->nom }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="sous_categorie">Sous-catégorie</label>
                    <select name="sous_categorie_id" id="sous_categorie" class="form-control mt-2">
                        <option value="">Sélectionner une sous-catégorie</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="nom_document">Nom du Document</label>
                    <input type="text" name="nom_document" id="nom_document" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="file_url">Fichier</label>
                    <input type="file" name="file_url" id="file_url" class="form-control" required>
                    <a id="view_file" href="#" target="_blank" class="btn btn-info mt-2 d-none">Voir le fichier</a>
                </div>

                <div class="form-group">
                    @php
                        $permission = Auth::user()->permissionrh ?? null;
                        @endphp

                        @if(in_array($permission, ['rh', 'valideur']))
                        <label for="user_id">Utilisateur</label>

                    <select name="user_id" id="user_id" class="form-control" required>
                        <option value="">Sélectionner un utilisateur</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}">{{ $user->nom }}</option>
                        @endforeach
                    </select>
                    @else
                    <label for="user_id">Pour moi :</label>

                    <select name="user_id" id="user_id" class="form-control" required>
                    <option value="{{Auth::user()->id}}">{{Auth::user()->nom}}</option>

@endif
                </div>

                <button type="submit" class="btn btn-success mt-3">Ajouter</button>
            </form>
        </div>
    </div>
</div>

<!-- Styles -->
<style>
.custom-card {
    border: 2px dashed #038C4F;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    padding: 20px;
    background-color: #f9f9f9;
    transition: transform 0.2s, box-shadow 0.2s;
}
.custom-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
}
.btn-success {
    background-color: #038C4F;
    border-color: #038C4F;
}
.btn-success:hover {
    background-color: #026838;
    border-color: #026838;
}
.form-label {
    font-weight: bold;
    color: #333;
}
.form-control {
    border: 1px solid #ddd;
    border-radius: 5px;
}
.form-control:focus {
    border-color: #038C4F;
    box-shadow: 0 0 5px rgba(3, 140, 79, 0.5);
}
</style>

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    // Charger les sous-catégories dynamiquement
    $('#categorie').change(function() {
        let categorie_id = $(this).val();
        
        if (categorie_id) {
            $.ajax({
                url: '/get-sous-categories/' + categorie_id,
                type: 'GET',
                success: function(response) {
                    $('#sous_categorie').html('<option value="">Sélectionner une sous-catégorie</option>');
                    response.forEach(function(sous_categorie) {
                        $('#sous_categorie').append('<option value="'+ sous_categorie.id +'">'+ sous_categorie.nom +'</option>');
                    });
                }
            });
        } else {
            $('#sous_categorie').html('<option value="">Sélectionner une sous-catégorie</option>');
        }
    });

    // Afficher un bouton pour voir le fichier sélectionné
    $('#file_url').change(function(event) {
        let file = event.target.files[0];
        if (file) {
            let url = URL.createObjectURL(file);
            $('#view_file').attr('href', url).removeClass('d-none');

            // Vérifier l'extension du fichier
            let ext = file.name.split('.').pop().toLowerCase();
            if (['jpg', 'jpeg', 'png', 'gif', 'pdf'].includes(ext)) {
                $('#view_file').text('Voir le fichier');
            } else {
                $('#view_file').text('Télécharger le fichier');
            }
        } else {
            $('#view_file').addClass('d-none');
        }
    });
});
</script>
@endsection
