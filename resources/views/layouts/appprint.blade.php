<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="title" content="FPH-CI Documents">
    <meta name="author" content="FPH-CI">
    <meta name="description" content="Documents officiels FPH-CI">
    <title>@yield('title', 'Document FPH-CI')</title>
    
    <style>
        @page {
            margin: 1cm;
        }
        body {
            font-family: 'Arial Narrow', Arial, sans-serif;
            line-height: 1.3;
            color: #000;
            margin: 0;
            padding: 0;
            background-color: white;
        }
        .container-fluid {
            width: 100%;
            padding-right: 15px;
            padding-left: 15px;
            margin-right: auto;
            margin-left: auto;
        }
        .row {
            display: flex;
            flex-wrap: wrap;
            margin-right: -15px;
            margin-left: -15px;
        }
        .col-md-2 {
            flex: 0 0 16.666667%;
            max-width: 16.666667%;
        }
        .col-md-5 {
            flex: 0 0 41.666667%;
            max-width: 41.666667%;
        }
        .col-md-6 {
            flex: 0 0 50%;
            max-width: 50%;
        }
        .col-md-12 {
            flex: 0 0 100%;
            max-width: 100%;
        }
        .text-center {
            text-align: center;
        }
        .text-left {
            text-align: left;
        }
        .text-right {
            text-align: right;
        }
        .text-end {
            text-align: right;
        }
        .text-start {
            text-align: left;
        }
        .mb-4 {
            margin-bottom: 1.5rem;
        }
        .mt-4 {
            margin-top: 1.5rem;
        }
        .mt-5 {
            margin-top: 3rem;
        }
        .py-3 {
            padding-top: 1rem;
            padding-bottom: 1rem;
        }
        hr {
            border: none;
            height: 2px;
            background-color: black;
            margin: 0;
            margin-top: 20px;
        }
        footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            font-size: 10pt;
        }
        u {
            text-decoration: underline;
        }
        strong {
            font-weight: bold;
        }
        h3 {
            font-size: 16pt;
            margin-top: 10px;
            margin-bottom: 15px;
        }
        h5 {
            font-size: 14pt;
            margin-top: 5px;
            margin-bottom: 10px;
        }
        p {
            margin-top: 5px;
            margin-bottom: 8px;
        }
        .header-container {
            margin-bottom: 20px;
        }
        .signature-container {
            margin-top: 20px;
        }
        .content-container {
            margin-bottom: 60px; /* Pour éviter que le contenu ne chevauche le footer */
        }
    </style>

    @stack('styles')
</head>
<body>
    <div class="container">
        <div class="row header-container">
            <div class="col-md-5">
@if(file_exists(public_path('image.png')))
    <img src="{{ public_path('image.png') }}" width="120" height="58" alt="Logo FPH-CI">
@else
    <!-- Texte alternatif -->
    <h3>FPH-CI</h3>
@endif                <h5><strong>DIRECTION EXECUTIVE</strong></h5>
            </div> 
            <div class="col-md-12"  style="text-align: right;">
                <h5><strong>FEDERATION DES O.P.A DE PRODUCTEURS<br>DE LA FILIERE HEVEA DE COTE D'IVOIRE</strong></h5>
            </div>
           
        </div>

        <div class="content-container">
            @yield('content')
        </div>
    </div>

    <footer>
        <hr>
        <div class="container-fluid py-3">
            <p style="font-size: 9pt; margin: 0;">
                <strong>Siège social :</strong> Abidjan Cocody Angré, Terminus 81-82, entre le 
                collège Commandant Cousteau et la pharmacie du Jubilé,
                <strong>BP 910 Abidjan 28</strong>,
                <strong>Tél :</strong> 27-22-47-59-62,
                <strong>Email :</strong> info@fphci.com
            </p>
        </div>
    </footer>
</body>
</html>