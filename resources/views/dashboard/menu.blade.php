<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-success bg-success">
    <div class="container-fluid">
        <a class="navbar-brand text-white" href="#">Filiere Hevea</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
   
                <li class="nav-item">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-danger">Déconnexion <i class="bi bi-box-arrow-right"></i></button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Contenu -->
<div class="container mt-4">
    <div class="row">
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <i class="bi bi-folder-fill fs-1 text-success"></i>
                    <h5 class="card-title mt-2">Gestion des documents</h5>
                    <a href="{{ route('dashboard') }}" class="btn btn-success">Accéder</a>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <i class="bi bi-file-earmark-text-fill fs-1 text-success"></i>
                    <h5 class="card-title mt-2">Gestion des demandes</h5>
                    <a href="{{ route('dashboardrh') }}" class="btn btn-success">Accéder</a>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
