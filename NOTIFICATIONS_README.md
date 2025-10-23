# Système de Notifications Email

## Vue d'ensemble

Ce système de notifications email a été implémenté pour envoyer automatiquement des notifications lors de :
- Création de documents
- Partage de documents
- Validation/rejet de demandes et autorisations
- Création de nouvelles demandes

## Configuration Email

### Serveur SMTP
- **Serveur sortant** : mail.fphci.com
- **Port SMTP** : 465
- **Chiffrement** : SSL
- **Authentification** : Requise
- **Email expéditeur** : notification.archivage@fphci.com

### Configuration dans .env
```
MAIL_MAILER=smtp
MAIL_HOST=mail.fphci.com
MAIL_PORT=465
MAIL_USERNAME=notification.archivage@fphci.com
MAIL_PASSWORD=your_email_password
MAIL_ENCRYPTION=ssl
MAIL_FROM_ADDRESS=notification.archivage@fphci.com
MAIL_FROM_NAME="filiere"
```

**Important** : Remplacez `your_email_password` par le mot de passe réel du compte email.

## Types de Notifications

### 1. Création de Documents
- **Déclencheur** : Création d'un nouveau document
- **Destinataires** : 
  - Utilisateurs avec permissions 'superieur' ou 'validateur' (RH exclus)
  - Utilisateurs avec rôles 'vise', 'directeurexecutif', 'pca', 'secretariat', 'admin'
- **Template** : `emails/document_created.blade.php`
- **Note** : Les utilisateurs RH ne reçoivent plus ces notifications

### 2. Partage de Documents
- **Déclencheur** : Partage d'un document avec des utilisateurs ou groupes
- **Destinataires** : Utilisateurs avec qui le document est partagé, mais uniquement ceux ayant :
  - L'un des rôles : 'vise', 'directeurexecutif', 'pca', 'secretariat', 'admin'
  - Ou des permissions 'rh', 'superieur', ou 'validateur'
- **Template** : `emails/document_shared.blade.php`
- **Note** : Filtrage intelligent pour éviter le spam aux utilisateurs non concernés

### 3. Validation/Rejet de Demandes
- **Déclencheur** : Validation ou rejet d'une demande/autorisation
- **Destinataires** : Utilisateur concerné par la demande
- **Template** : `emails/validation_notification.blade.php`
- **Types supportés** :
  - Demandes spéciales
  - Autorisations d'absence
  - Certificats de travail
  - Attestations de travail
  - Demandes d'absence
  - Demandes de congés

### 4. Nouvelles Demandes
- **Déclencheur** : Création d'une nouvelle demande
- **Destinataires** : 
  - **Validateurs concernés** : Validateurs du même service que le créateur + validateurs généraux (permissionrh: 'validateur', 'rh', 'valideur')
  - **Utilisateurs avec rôles spéciaux** : 'vise', 'directeurexecutif', 'pca', 'admin' (reçoivent TOUTES les notifications)
  - **Utilisateurs RH** : permissionrh 'rh', 'valideur' (reçoivent TOUTES les notifications peu importe le service)
  - **Supérieurs** : Le supérieur spécifique assigné à la demande (si défini dans id_superieur) OU les supérieurs du même service que le créateur
- **Template** : `emails/new_request.blade.php`
- **Note** : Ciblage intelligent avec priorité RH et direction - les rôles élevés et RH reçoivent toutes les notifications

## Contrôleurs Intégrés

Les notifications ont été intégrées dans les contrôleurs suivants :

1. **DemandeSpecialeController** - Demandes spéciales
2. **CertificatTravailController** - Certificats de travail
3. **AutorisationAbsenceController** - Autorisations d'absence
4. **DemandeAbsenceController** - Demandes d'absence
5. **DemandeDepartCongesController** - Demandes de congés
6. **AttestationTravailController** - Attestations de travail
7. **DocumentController** - Documents et partages

## Service de Notification

Le service `NotificationService` (`app/Services/NotificationService.php`) centralise la logique d'envoi des emails avec les méthodes :

- `notifyDocumentCreation()` - Notification de création de document
- `notifyDocumentShared()` - Notification de partage de document
- `notifyValidation()` - Notification de validation/rejet
- `notifyNewRequest()` - Notification de nouvelle demande

## Templates Email

Tous les templates sont situés dans `resources/views/emails/` :

- `document_created.blade.php`
- `document_shared.blade.php`
- `validation_notification.blade.php`
- `new_request.blade.php`

## Utilisation

Les notifications sont automatiquement déclenchées lors des actions suivantes :

1. **Création de document** → Notification aux RH/supérieurs/validateurs
2. **Partage de document** → Notification aux utilisateurs concernés
3. **Validation de demande** → Notification à l'utilisateur demandeur
4. **Rejet de demande** → Notification à l'utilisateur demandeur
5. **Nouvelle demande** → Notification aux RH/supérieurs/validateurs

## Dépannage

### Problèmes courants

1. **Emails non envoyés**
   - Vérifiez la configuration SMTP dans `.env`
   - Vérifiez les logs Laravel dans `storage/logs/`
   - Testez la connexion SMTP

2. **Erreurs d'authentification**
   - Vérifiez le nom d'utilisateur et mot de passe
   - Assurez-vous que le compte email existe

3. **Templates non trouvés**
   - Vérifiez que tous les fichiers de templates existent
   - Vérifiez les permissions des fichiers

### Test des notifications

Pour tester le système :
1. Configurez correctement le mot de passe email dans `.env`
2. Créez une nouvelle demande ou document
3. Vérifiez les logs pour les erreurs
4. Vérifiez la réception des emails

## Sécurité

- Le mot de passe email doit être sécurisé
- Les templates échappent automatiquement les données utilisateur
- Seuls les utilisateurs autorisés reçoivent les notifications


Nom d'utilisateur :	notification.archivage@fphci.com
Mot de passe :	Utilisez le mot de passe du compte de messagerie.
Serveur entrant :	mail.fphci.com
IMAP Port: 993 POP3 Port: 995
Serveur sortant :	mail.fphci.com
SMTP Port: 465
IMAP, POP3 et SMTP require authentication. cree un systeme de notification pour :
les document partage ,
creation (notifier les   rh superieur validateur)
, les validation (notifier le user concerne par la demande ou Autorisations) :
Autorisations d'Absence ,
Attestations de Travail,
Certificats de Travail,
 Demandes d'Absence,
 demandes de congés,
 
 Demandes Spéciales (notifier les user dont permissionrh est rh superieur validateur )