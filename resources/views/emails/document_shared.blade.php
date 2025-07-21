<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Document partagé avec vous</title>
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
            background-color: #28a745;
            color: white;
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
            background-color: #28a745;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin: 10px 0;
        }
        .info-box {
            background-color: white;
            padding: 15px;
            border-left: 4px solid #28a745;
            margin: 15px 0;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Document Partagé</h1>
    </div>
    
    <div class="content">
        <p>Bonjour {{ $sharedWith->nom }},</p>
        
        <p>{{ $sharedBy->nom }} a partagé un document avec vous.</p>
        
        <div class="info-box">
            <h3>Détails du document :</h3>
            <ul>
                <li><strong>Nom du document :</strong> {{ $document->nom }}</li>
                <li><strong>Type :</strong> {{ $document->type_doc }}</li>
                <li><strong>Partagé par :</strong> {{ $sharedBy->nom }}</li>
                <li><strong>Date de partage :</strong> {{ now()->format('d/m/Y à H:i') }}</li>
                <li><strong>Type de partage :</strong> {{ $document->type_share }}</li>
            </ul>
        </div>
        
        <p>Vous pouvez maintenant accéder à ce document dans la section "Documents partagés avec moi".</p>
        
        <a href="{{ url('/documents/shared-with-me') }}" class="btn">Voir les documents partagés</a>
    </div>
    
    <div class="footer">
        <p>Ceci est un message automatique du Système de Gestion Documentaire - FPHCI</p>
        <p>Merci de ne pas répondre à cet email.</p>
    </div>
</body>
</html>