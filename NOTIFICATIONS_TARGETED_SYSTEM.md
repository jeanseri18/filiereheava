# Système de Notifications Ciblées

## Vue d'ensemble

Le système de notifications a été modifié pour implémenter un ciblage plus précis des destinataires selon le type de demande et le service de l'utilisateur.

## Logique de Ciblage

### Principe
Au lieu de notifier tous les validateurs du système, les notifications sont maintenant envoyées uniquement aux :
1. **Validateurs concernés** par le type de demande spécifique
2. **Supérieurs directs** de l'utilisateur créateur de la demande

### Types de Demandes Supportés

Le système reconnaît les types suivants (tels qu'utilisés dans les contrôleurs) :

- `autorisation d'absence` → AutorisationAbsenceController
- `attestation de travail` → AttestationTravailController  
- `certificat de travail` → CertificatTravailController
- `demande d'absence` → DemandeAbsenceController
- `demande de congé` → DemandeDepartCongesController
- `demande spéciale` → DemandeSpecialeController

### Critères de Sélection des Validateurs

Pour chaque type de demande, les validateurs sélectionnés sont :

1. **Validateurs du même service** que le créateur de la demande (permissionrh: 'validateur', 'rh', 'valideur')
2. **Validateurs généraux** (sans service spécifique assigné)
3. **Utilisateurs avec rôles spéciaux** : `vise`, `directeurexecutif`, `pca`, `admin` (reçoivent TOUTES les notifications)
4. **Utilisateurs RH** : permissionrh `rh`, `valideur` (reçoivent TOUTES les notifications peu importe le service)

### Logique des Supérieurs

1. **Supérieur spécifique** : Si la demande a un `id_superieur` défini, ce supérieur sera notifié
2. **Supérieurs du service** : Sinon, tous les supérieurs du même service que le créateur seront notifiés

## Implémentation Technique

### Méthode `getConcernedValidators()`

```php
private function getConcernedValidators(string $type, int $serviceId)
{
    return User::where(function ($query) use ($serviceId) {
        // Validateurs du même service ou validateurs généraux
        $query->where(function ($subQuery) use ($serviceId) {
            $subQuery->whereIn('permissionrh', ['validateur', 'rh', 'valideur'])
                   ->where('status', 'actif')
                   ->where(function ($serviceQuery) use ($serviceId) {
                       $serviceQuery->where('id_service', $serviceId)
                                  ->orWhereNull('id_service'); // Validateurs généraux
                   });
        })
        // Utilisateurs avec rôles spéciaux (reçoivent toutes les notifications)
        ->orWhere(function ($subQuery) {
            $subQuery->whereIn('role', ['vise', 'directeurexecutif', 'pca', 'admin'])
                   ->where('status', 'actif');
        })
        // Utilisateurs RH (reçoivent toutes les notifications)
        ->orWhere(function ($subQuery) {
            $subQuery->whereIn('permissionrh', ['rh', 'valideur'])
                   ->where('status', 'actif');
        });
    })->get();
}
```

### Méthode `notifyNewRequest()` Modifiée

```php
public function notifyNewRequest($model, string $type, User $creator): void
{
    $recipients = collect();
    
    // Inclure seulement les validateurs concernés
    $concernedValidators = $this->getConcernedValidators($type, $creator->id_service);
    $recipients = $recipients->merge($concernedValidators);
    
    // Logique pour les supérieurs (inchangée)
    // ...
}
```

## Avantages du Nouveau Système

1. **Réduction du spam** : Moins de notifications non pertinentes
2. **Ciblage précis** : Seuls les utilisateurs concernés sont notifiés
3. **Respect de la hiérarchie** : Les supérieurs du service sont inclus
4. **Flexibilité** : Possibilité d'avoir des validateurs généraux
5. **Évolutivité** : Facile d'ajouter de nouveaux types de demandes

## Configuration

### Ajout d'un Nouveau Type de Demande

Pour ajouter un nouveau type :

1. Ajouter l'entrée dans `$typeMapping` de `getConcernedValidators()`
2. Utiliser le même nom de type dans l'appel `notifyNewRequest()` du contrôleur
3. S'assurer que les permissions/rôles sont correctement définis

### Validateurs Généraux

Les validateurs avec `id_service = NULL` recevront les notifications pour tous les types de demandes de tous les services.

## Exemple de Flux

1. Un utilisateur du service "Comptabilité" (id_service = 2) crée une demande d'absence
2. Le système identifie les destinataires :
   - Validateurs avec `permissionrh IN ('validateur', 'rh', 'valideur')` ET (`id_service = 2` OU `id_service IS NULL`)
   - Utilisateurs avec `role IN ('vise', 'directeurexecutif', 'pca', 'admin')` ET `status = 'actif'` (peu importe le service)
   - Utilisateurs avec `permissionrh IN ('rh', 'valideur')` ET `status = 'actif'` (peu importe le service)
   - Supérieurs avec `permissionrh = 'superieur'` ET `id_service = 2`
3. Les notifications sont envoyées à ces utilisateurs ciblés

## Migration depuis l'Ancien Système

L'ancien système notifiait tous les validateurs. Le nouveau système est rétrocompatible mais plus sélectif :

- **Avant** : Tous les validateurs + supérieurs
- **Maintenant** : Validateurs concernés + supérieurs du service

Aucune modification de base de données n'est requise.