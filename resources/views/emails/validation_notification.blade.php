<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Notification de validation</title>
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
            color: white;
            padding: 20px;
            text-align: center;
            border-radius: 5px 5px 0 0;
        }
        .header.validated {
            background-color: #28a745;
        }
        .header.rejected {
            background-color: #dc3545;
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
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin: 10px 0;
        }
        .btn.validated {
            background-color: #28a745;
        }
        .btn.rejected {
            background-color: #dc3545;
        }
        .info-box {
            background-color: white;
            padding: 15px;
            margin: 15px 0;
        }
        .info-box.validated {
            border-left: 4px solid #28a745;
        }
        .info-box.rejected {
            border-left: 4px solid #dc3545;
        }
        .status-badge {
            padding: 5px 10px;
            border-radius: 3px;
            color: white;
            font-weight: bold;
        }
        .status-badge.validated {
            background-color: #28a745;
        }
        .status-badge.rejected {
            background-color: #dc3545;
        }
    </style>
</head>
<body>
    <div class="header {{ $status === 'validé' ? 'validated' : 'rejected' }}">
        <h1>{{ $status === 'validé' ? '✓' : '✗' }} {{ ucfirst($type) }} {{ $status }}</h1>
    </div>
    
    <div class="content">
        <p>Bonjour {{ $user->nom }},</p>
        
        <p>Votre {{ $type }} a été <span class="status-badge {{ $status === 'validé' ? 'validated' : 'rejected' }}">{{ strtoupper($status) }}</span></p>
        
        <div class="info-box {{ $status === 'validé' ? 'validated' : 'rejected' }}">
            <h3>Détails de la {{ $type }} :</h3>
            <ul>
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
                @endif
                
                @if($validator)
                    <li><strong>{{ $status === 'validé' ? 'Validé' : 'Rejeté' }} par :</strong> {{ $validator->nom }}</li>
                @endif
                
                @if(isset($model->date_validation) && $model->date_validation)
                    <li><strong>Date de {{ $status === 'validé' ? 'validation' : 'rejet' }} :</strong> {{ $model->date_validation->format('d/m/Y à H:i') }}</li>
                @endif
            </ul>
        </div>
        
        @if($status === 'validé')
            <p>Félicitations ! Votre demande a été approuvée. Vous pouvez maintenant procéder selon les instructions de votre organisation.</p>
        @else
            <p>Votre demande n'a pas pu être approuvée. Pour plus d'informations, veuillez contacter votre supérieur hiérarchique ou le service RH.</p>
        @endif
        
        <a href="{{ url('/') }}" class="btn {{ $status === 'validé' ? 'validated' : 'rejected' }}">Accéder au système</a>
    </div>
    
    <div class="footer">
        <p>Ceci est un message automatique du Système de Gestion Documentaire - FPHCI</p>
        <p>Merci de ne pas répondre à cet email.</p>
    </div>
</body>
</html>