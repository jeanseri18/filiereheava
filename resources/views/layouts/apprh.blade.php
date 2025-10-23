<!DOCTYPE html>
<html lang="en">

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
    <style>
    .sidebar-brand {
        display: flex;
        align-items: center;
        justify-content: center;
        height: 3.5rem;
        padding: 0.8125rem 0.5rem;
        overflow: hidden;
        font-size: 1.25rem;
        white-space: nowrap;
        transition: width 0.3s ease-in-out;
    }
    </style>
</head>

<body class="layout-fixed sidebar-expand-lg bg-body-tertiary" style="background-color:WHITE">
    <div class="app-wrapper" style="background-color:white">
        <nav class="app-header navbar navbar-expand bg-body" style="background-color:white">
            <!--begin::Container-->
            <div class="container-fluid">
                <!--begin::Start Navbar Links-->
                <ul class="navbar-nav">
<li class="nav-item"> <a class="nav-link"  data-lte-toggle="sidebar" href="#" role="button" > <i
                                data-lte-icon="menu" class="bi bi-list"></i> </a>
                    </li>
                   
</ul>
                <ul class="navbar-nav ms-auto">
                    <!--begin::Navbar Search-->
                    <li class="nav-item"> <a class=" btn btn-success" href="{{ route('dashboard') }}" > basculer
</a>
                    </li>
                    <li class="nav-item"> <a class="nav-link" href="#" data-lte-toggle="fullscreen"> <i
                                data-lte-icon="maximize" class="bi bi-arrows-fullscreen"></i> <i
                                data-lte-icon="minimize" class="bi bi-fullscreen-exit" style="display: none;"></i> </a>
                    </li>
                    <!--end::Fullscreen Toggle-->
                    <!--begin::User Menu Dropdown-->
                    <li class="nav-item dropdown user-menu">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <!-- Utilisation de l'icône Font Awesome pour l'utilisateur -->
                            <i class="bi bi-person-circle text-black" style="font-size: 1.5rem;color:black"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                            <!--begin::User Header-->
                            <li class="user-header bg-secondary">
                                <!-- Utilisation de l'icône Font Awesome pour l'utilisateur -->
                                <i class="bi bi-person-circle " style="font-size: 3rem;color:white"></i>
                                <p>
                                    {{ auth()->user()->nom }}

                                    <small> {{ auth()->user()->role }}</small>
                                </p>
                            </li>
                            <!--end::User Header-->
                            <!--begin::Menu Footer-->
                            <li class="user-footer">
                                <a href="{{ route('profile.edit') }}" class="btn btn-default btn-flat">Profile</a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                    style="display: none;">
                                    @csrf
                                </form>

                                <a href="#" class="btn btn-default btn-flat float-end"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    Déconnexion
                                </a>
                            </li>
                            <!--end::Menu Footer-->
                        </ul>
                    </li>

                    <!--end::User Menu Dropdown-->
                </ul>
                <!--end::End Navbar Links-->
            </div>
            <!--end::Container-->
        </nav>
        <!--end::Header-->
        <!--begin::Sidebar-->
        <aside class="app-sidebar  " data-bs-theme="dark" style="background-color:#038C4F;color:white">
            <!--begin::Sidebar Brand-->
            <div class="sidebar-brand">
                <!--begin::Brand Link--> <a href="#" class="brand-link">
                    <!--begin::Brand Image--> <img src="{{asset('logobg.png')}}" alt="AdminLTE Logo"
                        class="brand-image opacity-75 shadow">
                    <!--end::Brand Image-->
                    <!--begin::Brand Text-->
                    <!--end::Brand Text-->
                </a>
                <!--end::Brand Link-->
            </div>
            <!--end::Sidebar Brand-->
            <!--begin::Sidebar Wrapper-->
            <div class="sidebar-wrapper">
                <nav class="mt-2">
                    <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu"
                        data-accordion="false">
                        <!-- Tableau de bord -->
                        <li class="nav-item">
                            <a href="{{ route('dashboardrh') }}" class="nav-link" style="color:white">
                                <i class="nav-icon bi bi-speedometer2 text-white"></i>
                                <p>Tableau de bord</p>
                            </a>
                        </li>
                        <!--li class="nav-item">
                            <a href="{{ route('directions.index') }}" class="nav-link" style="color:white">
                                <i class="nav-icon bi bi-speedometer2 text-white"></i>
                                <p>Directions</p>
                            </a>
                        </li-->



                        @php
                        $permission = Auth::user()->permissionrh ?? null;
                        $role = Auth::user()->role ?? null;
                        @endphp

                        @if(in_array($permission, ['rh', 'valideur']))

                        <li class="nav-item">
                            <a href="{{ route('categories.index') }}" class="nav-link" style="color:white">
                                <i class="nav-icon bi bi-gear text-white"></i>
                                <p>Categorie</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('sous-categories.index') }}" class="nav-link" style="color:white">
                                <i class="nav-icon bi bi-gear text-white"></i>
                                <p>Sous categorie</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('document_rh.index') }}" class="nav-link" style="color:white">
                                <i class="nav-icon bi bi-gear text-white"></i>
                                <p>Document employé</p>
                            </a>
                        </li>
                        <li class="nav-item">
    <a href="{{ route('personnel.index') }}" class="nav-link" style="color:white">
        <i class="nav-icon bi bi-people text-white"></i>
        <p>Personnel</p>
    </a>
</li>

                        <li class="nav-item">
                            <a href="{{ route('autorisations.index') }}" class="nav-link" style="color:white">
                                <i class="nav-icon bi bi-gear text-white"></i>
                                <p>Autorisation d'absence</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('attestations_travail.index') }}" class="nav-link" style="color:white">
                                <i class="nav-icon bi bi-gear text-white"></i>
                                <p>Attestation de travail</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('attestations.index') }}" class="nav-link" style="color:white">
                                <i class="nav-icon bi bi-gear text-white"></i>
                                <p>Attestation de reprise </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('certificats.index') }}" class="nav-link" style="color:white">
                                <i class="nav-icon bi bi-gear text-white"></i>
                                <p>Certificat de travail</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('attestations_stage.index') }}" class="nav-link" style="color:white">
                                <i class="nav-icon bi bi-gear text-white"></i>
                                <p>Attestation de stage</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('attestations_conge.index') }}" class="nav-link" style="color:white">
                                <i class="nav-icon bi bi-file-earmark-text text-white"></i>
                                <p>Attestations de Congé</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('demandes_absence.index') }}" class="nav-link" style="color:white">
                                <i class="nav-icon bi bi-gear text-white"></i>
                                <p>Demande d'absence</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('demandes.index') }}" class="nav-link" style="color:white">
                                <i class="nav-icon bi bi-gear text-white"></i>
                                <p>Demande départ congé</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('ordres.index') }}" class="nav-link" style="color:white">
                                <i class="nav-icon bi bi-gear text-white"></i>
                                <p>Ordre de mission</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('demandes_speciales.index') }}" class="nav-link" style="color:white">
                                <i class="nav-icon bi bi-gear text-white"></i>
                                <p>Demande Special</p>
                            </a>
                        </li>
                        @endif

                     
                        
                        @if(in_array($permission, ['demandeur', 'superieur']))

@if(in_array($role, ['manager', 'secretariat']))
                                   <li class="nav-item">
                            <a href="{{ route('attestations_travail.index') }}" class="nav-link" style="color:white">
                                <i class="nav-icon bi bi-gear text-white"></i>
                                <p>Attestation de travail</p>
                            </a>
                        </li>
                        @endif
                        <li class="nav-item">
                            <a href="{{ route('demandes_absence.index') }}" class="nav-link" style="color:white">
                                <i class="nav-icon bi bi-gear text-white"></i>
                                <p>Demande d'absence</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('demandes.index') }}" class="nav-link" style="color:white">
                                <i class="nav-icon bi bi-gear text-white"></i>
                                <p>Demande départ congé</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('document_rh.index') }}" class="nav-link" style="color:white">
                                <i class="nav-icon bi bi-gear text-white"></i>
                                <p>Identification personnel</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('demandes_speciales.index') }}" class="nav-link" style="color:white">
                                <i class="nav-icon bi bi-gear text-white"></i>
                                <p>Demande Special</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('ordres.index') }}" class="nav-link" style="color:white">
                                <i class="nav-icon bi bi-gear text-white"></i>
                                <p>Ordre de mission</p>
                            </a>
                        </li>
                        
                        @endif


                        <!-- Paramètres -->
                        <li class="nav-item">
                            <a href="{{ route('profile.edit') }}" class="nav-link" style="color:white">
                                <i class="nav-icon bi bi-gear text-white"></i>
                                <p>Paramètres</p>
                            </a>
                        </li>
                    </ul>
                </nav>

            </div>
            <!--end::Sidebar Wrapper-->
        </aside>
        <!--end::Sidebar-->
        <!--begin::App Main-->

        <main class="app-main" style="background-color:white">
            <div class="app-content-header">
                <!--
                <div class="container-fluid"> 
                    <div class="row">
                        <div class="col-sm-6">
                            <h3 class="mb-0">Dashboard</h3>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-end">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    Dashboard
                                </li>
                            </ol>
                        </div>
                    </div>
                </div> 
            </div>
            <div class="app-content">
                <!--begin::Container-->
                <div class="container-fluid">
                    <!--begin::Row-->
                    @yield('content') {{-- Section pour le contenu principal --}}

                </div>
                <!--end::Container-->
            </div>
        </main>
    </div>

    <!-- Global scripts -->
    <script src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.3.0/browser/overlayscrollbars.browser.es6.min.js"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" crossorigin="anonymous">
    </script>
    <script src="../../dist/js/adminlte.js"></script>

    @stack('scripts') {{-- Inclure les scripts spécifiques à une page --}}
</body>

</html>