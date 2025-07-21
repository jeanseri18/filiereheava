<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Nouvelle demande créée</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background-color: #ffc107;
            color: #212529;
            padding: 20px;
            text-align: center;
            border-radius: 5px 5px 0 0;
        }
        .content {
            background-color: #f8f9fa;
            padding: 20px;
            border: 1px solid #dee2e6;
        }
        .footer {
            background-color: #6c757d;
            color: white;
            padding: 10px;
            text-align: center;
            border-radius: 0 0 5px 5px;
            font-size: 12px;
        }
        .btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #ffc107;
            color: #212529;
            text-decoration: none;
            border-radius: 5px;
            margin: 10px 0;
            font-weight: bold;
        }
        .info-box {
            background-color: white;
            padding: 15px;
            border-left: 4px solid #ffc107;
            margin: 15px 0;
        }
        .priority {
            background-color: #fff3cd;
            border: 1px solid #ffeaa7;
            padding: 10px;
            border-radius: 5px;
            margin: 10px 0;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>⚠️ Nouvelle {{ ucfirst($type) }}</h1>
    </div>
    
    <div class="content">
        <p>Bonjour {{ $recipient->nom }},</p>
        
        <div class="priority">
            <strong>🔔 Action requise :</strong> Une nouvelle {{ $type }} nécessite votre attention.
        </div>
        
        <p>{{ $creator->nom }} a créé une nouvelle {{ $type }} qui nécessite une validation.</p>
        
        <div class="info-box">
            <h3>Détails de la {{ $type }} :</h3>
            <ul>
                <li><strong>Créée par :</strong> {{ $creator->nom }} ({{ $creator->email }})</li>
                <li><strong>Service :</strong> {{ $creator->service->nom ?? 'Non défini' }}</li>
                <li><strong>Fonction :</strong> {{ $creator->fonction ?? 'Non définie' }}</li>
                <li><strong>Date de création :</strong> {{ $model->created_at->format('d/m/Y à H:i') }}</li>
                
                @if($type === 'demande spéciale')
                    <li><strong>Objet :</strong> {{ $model->objet }}</li>
                    <li><strong>Statut :</strong> {{ $model->status }}</li>
                @elseif($type === 'autorisation d\'absence')
                    <li><strong>Date début :</strong> {{ $model->date_debut->format('d/m/Y') }}</li>
                    <li><strong>Date fin :</strong> {{ $model->date_fin->format('d/m/Y') }}</li>
                    <li><strong>Nombre de jours :</strong> {{ $model->nombre_jours }}</li>
                    <li><strong>Raison :</strong> {{ $model->raison }}</li>
                @elseif($type === 'certificat de travail')
                    <li><strong>Date début :</strong> {{ $model->date_debut->format('d/m/Y') }}</li>
                    <li><strong>Date fin :</strong> {{ $model->date_fin->format('d/m/Y') }}</li>
                    <li><strong>Type de contrat :</strong> {{ $model->type_contrat }}</li>
                @elseif($type === 'attestation de travail')
                    <li><strong>Date d'embauche :</strong> {{ $model->date_embauche->format('d/m/Y') }}</li>
                    <li><strong>Lieu de travail :</strong> {{ $model->lieu_travail }}</li>
                    <li><strong>Type de contrat :</strong> {{ $model->type_contrat }}</li>
                @elseif($type === 'demande d\'absence')
                    <li><strong>Date début :</strong> {{ $model->date_debut->format('d/m/Y') }}</li>
                    <li><strong>Date fin :</strong> {{ $model->date_fin->format('d/m/Y') }}</li>
                    <li><strong>Nombre de jours :</strong> {{ $model->nombre_jours }}</li>
                    <li><strong>Objet :</strong> {{ $model->objet_demande }}</li>
                @elseif($type === 'demande de congé')
                    <li><strong>Date début :</strong> {{ $model->date_debut->format('d/m/Y') }}</li>
                    <li><strong>Date fin :</strong> {{ $model->date_fin->format('d/m/Y') }}</li>
                    <li><strong>Motif :</strong> {{ $model->motif }}</li>
                    <li><strong>Jours ouvrables :</strong> {{ $model->nombre_jours_ouvrables }}</li>
                    <li><strong>Adresse de séjour :</strong> {{ $model->adresse_sejour }}</li>
                @endif
            </ul>
        </div>
        
        <p><strong>En tant que {{ $recipient->permissionrh }}, vous pouvez maintenant examiner et traiter cette demande.</strong></p>
        
        <a href="{{ url('/') }}" class="btn">Accéder au système pour traiter</a>
    </div>
    
    <div class="footer">
        <p>Ceci est un message automatique du Système de Gestion Documentaire - FPHCI</p>
        <p>Merci de ne pas répondre à cet email.</p>
    </div>
</body>
</html>