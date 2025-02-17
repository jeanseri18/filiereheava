<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="title" content="Test">
    <meta name="author" content="ColorlibHQ">
    <meta name="description" content="AdminLTE is a Free Bootstrap 5 Admin Dashboard.">
    <meta name="keywords" content="bootstrap 5, admin dashboard, etc.">
    <title>@yield('title', 'Dashboard')</title>

    <!-- Global styles -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css"
        crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.3.0/styles/overlayscrollbars.min.css"
        crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.min.css"
        crossorigin="anonymous">
    <link rel="stylesheet" href="../../dist/css/adminlte.css">

    @stack('styles') {{-- Inclure les styles spécifiques à une page --}}

  
</head>

<body class="layout-fixed sidebar-expand-lg bg-body-tertiary" style="background-color:WHITE">
    <div class="app-wrapper" style="background-color:white">
       
        <main class="app-main" style="background-color:white">
            <div class="app-content-header"></div>
            <div class="app-content">
                <!--begin::Container-->
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-5">
                        <img
                src="https://myfiles.space/user_files/258325_0814ee78b0547536/1739287656_fiche-d-attestation-de-travail/1739287656_fiche-d-attestation-de-travail-2.jpeg"
                width="184" height="88" alt="C:\Users\SECRETARIAT\Downloads\IMG-20200624-WA0006.jpg"
                >          
            <br> 
            <br> 
            <h5><strong>DIRECTION EXECUTIVE  </strong></h5>            </div>
                        <div class="col-md-5">
                        <h5><strong>  FEDERATION DES O.P.A DE PRODUCTEURS <br>DE LA FILIERE HEVEA DE COTE D’IVOIRE </h5></strong>
                        </div>
                        <div class="col-md-2"></div>
                    </div>

                    <!-- Contenu principal -->
                    @yield('content') 

                </div>
                <!--end::Container-->
            </div>
        </main>
    </div>

    <!-- Pied de page -->
      <!-- Pied de page -->
      <footer class="text-center mt-4" >
        <!-- Ligne horizontale pleine largeur -->
        <hr style="width: 100%; height: 5px; border: none; background-color: black; margin: 0;">

        <div class="container py-3">
            <p style="font-family: 'Arial Narrow'; font-size: 10pt; margin: 0;">
                <strong>Siège social :</strong> Abidjan Cocody Angré, Terminus 81-82, entre le
                collège Commandant Cousteau et la pharmacie du Jubilé,  
                <strong>BP 910 Abidjan 28</strong>,  
                <strong>Tél :</strong> 27-22-47-59-62,  
                <strong>Email :</strong> info@fphci.com
            </p>
        </div>
    </footer>

    <!-- Global scripts -->
    <script src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.3.0/browser/overlayscrollbars.browser.es6.min.js"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" crossorigin="anonymous">
    </script>
    <script src="../../dist/js/adminlte.js"></script>

    @stack('scripts') {{-- Inclure les scripts spécifiques à une page --}}

    <!-- Script pour imprimer automatiquement -->
    <script>
        window.onload = function() {
            window.print();
        };
    </script>

</body>
</html>
