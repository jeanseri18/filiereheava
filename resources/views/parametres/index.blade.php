@extends('layouts.app')

@section('title', 'Profil Utilisateur')

@section('content')
<div class="container">

    <div class="row">
        {{-- Section : Informations sur le compte --}}
        <div class="col-md-12">
            <div class="card">
                <div class="mb-3">
                <br><br>
                    {{-- Affichage de la photo de profil --}}
                    <div class="text-center">
                        <label for="profile_photo_input" class="d-inline-block cursor-pointer">
                            <img src="" 
                                 alt="Photo de Profil" 
                                 class="profile-photo rounded-circle" 
                                 id="profile-photo-img" 
                                 style="width: 150px; height: 150px; object-fit: cover; border: 3px solid #ddd;">
                        </label>
                    </div>
                    <input type="file" class="form-control mt-2 d-none" id="profile_photo_input" name="profile_photo"><br><br>
                </div>
            </div><br><br>
        </div>

        {{-- Section : Informations utilisateur --}}
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5>Informations sur le compte</h5>
                </div>
                <div class="card-body">
                    <form action="" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        {{-- Nom complet --}}
                        <div class="mb-3">
                            <label for="full_name" class="form-label">Nom et Prénom</label>
                            <input type="text" class="form-control" id="full_name" name="full_name" value="{{ old('full_name', $user->full_name ?? '') }}" required>
                        </div>

                        {{-- Rôle --}}
                        <div class="mb-3">
                            <label for="role" class="form-label">Rôle</label>
                            <select class="form-select" id="role" name="role" required>
                                <option value="user" {{ old('role', $user->role ?? '') == 'user' ? 'selected' : '' }}>Utilisateur</option>
                                <option value="admin" {{ old('role', $user->role ?? '') == 'admin' ? 'selected' : '' }}>Administrateur</option>
                            </select>
                        </div>

                        {{-- Service --}}
                        <div class="mb-3">
                            <label for="service" class="form-label">Service</label>
                            <input type="text" class="form-control" id="service" name="service" value="{{ old('service', $user->service ?? '') }}" required>
                        </div>

                        {{-- Direction --}}
                        <div class="mb-3">
                            <label for="direction" class="form-label">Direction</label>
                            <input type="text" class="form-control" id="direction" name="direction" value="{{ old('direction', $user->direction ?? '') }}" required>
                        </div>

                        {{-- Bouton de validation --}}
                        <button type="submit" class="btn btn-success">Enregistrer les informations</button>
                    </form>
                </div>
            </div>
        </div>

        {{-- Section : Modification du mot de passe --}}
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5>Modification du mot de passe</h5>
                </div>
                <div class="card-body">
                    <form action="" method="POST">
                        @csrf
                        @method('PUT')

                        {{-- Mot de passe actuel --}}
                        <div class="mb-3">
                            <label for="current_password" class="form-label">Mot de Passe Actuel</label>
                            <input type="password" class="form-control" id="current_password" name="current_password" required>
                        </div>

                        {{-- Nouveau mot de passe --}}
                        <div class="mb-3">
                            <label for="password" class="form-label">Nouveau Mot de Passe</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>

                        {{-- Confirmation du nouveau mot de passe --}}
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Confirmer le Nouveau Mot de Passe</label>
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                        </div>

                        {{-- Bouton de validation --}}
                        <button type="submit" class="btn btn-warning">Modifier le mot de passe</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Script pour changer la photo de profil en cliquant dessus
    const profilePhotoInput = document.getElementById('profile_photo_input');
    const profilePhotoLabel = document.querySelector('label[for="profile_photo_input"]');
    const profilePhotoImage = document.getElementById('profile-photo-img');

    // Lorsque l'utilisateur clique sur l'image, on déclenche le champ de fichier
    profilePhotoLabel.addEventListener('click', function() {
        profilePhotoInput.click();
    });

    // Lorsque l'utilisateur sélectionne un fichier, on met à jour l'image
    profilePhotoInput.addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                profilePhotoImage.src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    });
</script>
@endpush