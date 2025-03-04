<div class="form-group mb-3">
    <label for="nom">Nom</label>
    <input type="text" name="nom" id="nom" class="form-control" value="{{ old('nom', $user->nom ?? '') }}" required>
</div>
<div class="form-group mb-3">
    <label for="email">Email</label>
    <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $user->email ?? '') }}"
        required>
</div>
<div class="form-group mb-3">
                    <label for="matricule" class="form-label">Matricule</label>
                    <input type="text" class="form-control" id="matricule" name="matricule"  value="{{ old('matricule', $user->matricule ?? '') }}">
                </div>
                <div class="form-group mb-3">
                    <label for="fonction" class="form-label">Fonction</label>
                    <input type="text" class="form-control" id="fonction" name="fonction"  value="{{ old('fonction', $user->fonction ?? '') }}">
                </div>
<div class="form-group mb-3">
                    <label for="numcnps" class="form-label">num cnps/ num de paie</label>
                    <input type="text" class="form-control" id="numcnps" name="numcnps"  value="{{ old('numcnps', $user->numcnps ?? '') }}">
                </div>
                <div class="form-group mb-3">
    <label for="role">Rôle</label>
    <select name="role" id="role" class="form-control" required>
        <option value="">Sélectionner un rôle</option>
        <option value="admin" {{ old('role', $user->role ?? '') == 'admin' ? 'selected' : '' }}>Administrateur</option>
        <option value="user" {{ old('role', $user->role ?? '') == 'user' ? 'selected' : '' }}>Utilisateur</option>
        <option value="manager" {{ old('role', $user->role ?? '') == 'manager' ? 'selected' : '' }}>Responsable</option>
        <option value="vise" {{ old('role', $user->role ?? '') == 'vise' ? 'selected' : '' }}>Vice-président</option>
        <option value="directeurexecutif" {{ old('role', $user->role ?? '') == 'directeurexecutif' ? 'selected' : '' }}>Directeur exécutif</option>
        <option value="pca" {{ old('role', $user->role ?? '') == 'pca' ? 'selected' : '' }}>PCA</option>
        <option value="secretariat" {{ old('role', $user->role ?? '') == 'secretariat' ? 'selected' : '' }}>Secrétariat</option>
    </select>
</div>

<div class="mb-3">
    <label for="permissionrh" class="form-label">Permission RH</label>
    <select class="form-select" id="permissionrh" name="permissionrh" required>
        <option value="rh" {{ old('permissionrh', $user->permissionrh ?? '') == 'rh' ? 'selected' : '' }}>rh </option>
        <option value="demandeur" {{ old('permissionrh', $user->permissionrh ?? '') == 'demandeur' ? 'selected' : '' }}>
            demandeur</option>
        <option value="valideur" {{ old('permissionrh', $user->permissionrh ?? '') == 'valideur' ? 'selected' : '' }}>
            valideur </option>
        <option value="superieur" {{ old('permissionrh', $user->permissionrh ?? '') == 'superieur' ? 'selected' : '' }}>
            Superieur </option>

    </select>
</div>
<div class="form-group mb-3">
    <label for="id_service">Service</label>
    <select name="id_service" id="id_service" class="form-control" required>
        @foreach($services as $service)
        <option value="{{ $service->id }}"
            {{ old('id_service', $user->id_service ?? '') == $service->id ? 'selected' : '' }}>{{ $service->nom }}
        </option>
        @endforeach
    </select>
</div>
<div class="form-group mb-3">
    <label for="is_validator">Validateur</label>
    <input type="checkbox" name="is_validator" id="is_validator" value="1"
        {{ old('is_validator', $user->is_validator ?? false) ? 'checked' : '' }}>
</div>
<div class="form-group mb-3">
    <label for="status">Statut</label>
    <select name="status" id="status" class="form-control" required>
        <option value="actif" {{ old('status', $user->status ?? '') == 'actif' ? 'selected' : '' }}>Actif</option>
        <option value="inactif" {{ old('status', $user->status ?? '') == 'inactif' ? 'selected' : '' }}>Inactif</option>
    </select>
</div>

<!-- Champ Mot de passe visible uniquement lors de la création -->
@if (!$user)
<div class="form-group mb-3">
    <label for="password">Mot de passe</label>
    <input type="password" name="password" id="password" class="form-control" required>
</div>
@endif
<br>
<button type="submit" class="btn btn-success">Enregistrer</button>