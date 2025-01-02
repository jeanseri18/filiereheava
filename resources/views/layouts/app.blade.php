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

                <ul class="navbar-nav ms-auto">
                    <!--begin::Navbar Search-->

                    <li class="nav-item"> <a class="nav-link" href="#" data-lte-toggle="fullscreen"> <i
                                data-lte-icon="maximize" class="bi bi-arrows-fullscreen"></i> <i
                                data-lte-icon="minimize" class="bi bi-fullscreen-exit" style="display: none;"></i> </a>
                    </li>
                    <!--end::Fullscreen Toggle-->
                    <!--begin::User Menu Dropdown-->
                    <li class="nav-item dropdown user-menu"> <a href="#" class="nav-link dropdown-toggle"
                            data-bs-toggle="dropdown"> <img src="../../dist/assets/img/user2-160x160.jpg"
                                class="user-image rounded-circle shadow" alt="User Image"><span
                                class="d-none d-md-inline">Alexander Pierce</span> </a>
                        <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                            <!--begin::User Image-->
                            <li class="user-header text-bg-primary"> <img src="../../dist/assets/img/user2-160x160.jpg"
                                    class="rounded-circle shadow" alt="User Image">
                                <p>
                                    Alexander Pierce - Web Developer
                                    <small>Member since Nov. 2023</small>
                                </p>
                            </li>
                            <!--end::User Image-->
                            <!--begin::Menu Body-->
                            <!--end::Menu Body-->
                            <!--begin::Menu Footer-->
                            <li class="user-footer"> <a href="{{ route('profile.edit') }}" class="btn btn-default btn-flat">Profile</a> <a
                                    href="{{ route('logout') }}" class="btn btn-default btn-flat float-end">Deconnexion</a> </li>
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
                    <!--begin::Brand Image--> <img src="logobg.png" alt="AdminLTE Logo"
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
                            <a href="{{ route('dashboard') }}" class="nav-link" style="color:white">
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
                        <li class="nav-item">
                            <a href="{{ route('services.index') }}" class="nav-link" style="color:white">
                                <i class="nav-icon bi bi-speedometer2 text-white"></i>
                                <p>Directions</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('courriers.index') }}" class="nav-link" style="color:white">
                                <i class="nav-icon bi bi-speedometer2 text-white"></i>
                                <p>Courriers</p>
                            </a>
                        </li>

                                <!-- Mes documents -->
                                <li class="nav-item">
                                    <a href="{{ route('documents.index') }}" class="nav-link" style="color:white">
                                        <i class="nav-icon bi bi-folder text-white"></i>
                                        <p>Mes documents</p>
                                    </a>
                                </li> 
                                <!-- Documents en attente de validation -->
                                <li class="nav-item">
                            <a href="{{ route('archives.index') }}" class="nav-link" style="color:white">
                                <i class="nav-icon bi bi-clock text-white"></i>
                                <p>Archivages</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('share_groups.index') }}" class="nav-link" style="color:white">
                                <i class="nav-icon bi bi-clock text-white"></i>
                                <p>Groupe de partage</p>
                            </a>
                        </li>
                        <!-- Historique -->
                        <li class="nav-item">
                            <a href="{{ route('histories.index') }}" class="nav-link" style="color:white">
                                <i class="nav-icon bi bi-clock text-white"></i>
                                <p>Historique</p>
                            </a>
                        </li>
                        <!-- Utilisateur -->
                        <li class="nav-item">
                            <a href="{{ route('users.index') }}" class="nav-link" style="color:white">
                                <i class="nav-icon bi bi-person text-white"></i>
                                <p>Utilisateur</p>
                            </a>
                        </li>
               
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
                </div> end::Row-->
            </div>
            <div class="app-content" >
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