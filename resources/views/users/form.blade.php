<div class="form-group mb-3">
    <label for="nom">Nom</label>
    <input type="text" name="nom" id="nom" class="form-control" value="{{ old('nom', $user->nom ?? '') }}" required>
</div>
<div class="form-group mb-3">
    <label for="email">Email</label>
    <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $user->email ?? '') }}" required>
</div>
<div class="form-group mb-3">
    <label for="role">Rôle</label>
    <select name="role" id="role" class="form-control" required>
        <option value="admin" {{ old('role', $user->role ?? '') == 'admin' ? 'selected' : '' }}>Admin</option>
        <option value="employe" {{ old('role', $user->role ?? '') == 'employe' ? 'selected' : '' }}>Employé</option>
        <option value="manager" {{ old('role', $user->role ?? '') == 'manager' ? 'selected' : '' }}>Manager</option>
    </select>
</div>
<div class="form-group mb-3">
    <label for="id_service">Service</label>
    <select name="id_service" id="id_service" class="form-control" required>
        @foreach($services as $service)
            <option value="{{ $service->id }}" {{ old('id_service', $user->id_service ?? '') == $service->id ? 'selected' : '' }}>{{ $service->nom }}</option>
        @endforeach
    </select>
</div>
<div class="form-group mb-3">
    <label for="is_validator">Validateur</label>
    <input type="checkbox" name="is_validator" id="is_validator" value="1" {{ old('is_validator', $user->is_validator ?? false) ? 'checked' : '' }}>
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
