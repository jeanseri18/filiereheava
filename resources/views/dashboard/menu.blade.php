<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Formulaire de Connexion</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
</head>
<body>
<style>@media (max-width: 768px) {
    .hidden-on-mobile {
        display: none !important;
    }
}@media (min-width: 768px) {
    .hidden-two-on-mobile {
      padding-top:150px;
    }
    .logout {
        display: none !important;
    }
}
</style>

  <div class="container-fluid vh-100 d-flex align-items-center">
    <div class="row w-100">

      <!-- Colonne gauche : Texte et Logo -->
      <div class="col-md-6 d-flex hidden-on-mobile flex-column  align-text-center justify-content-center text-white" style="background-color:#038C4F; height: 850px;">
      <div style="padding-top:50px;">
       <center><img src="logobg.png" alt="Logo" class="mb-4" style="width: 350px;"></center>
      </div>
<div style="padding-top:450px;">
      <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-lg form-control btn-dark text-white">Déconnexion <i class="bi bi-box-arrow-right"></i></button>
                    </form></div>
      </div>

      <!-- Colonne droite : Formulaire et cartes -->
      <div class="col-md-6 bg-white d-flex flex-column hidden-two-on-mobile" >
   <center>   <h3 class="card-title mt-2 align-item-center text-align-center">Choissisez une session pour demarrer</h3></center>
<br/>
<br/>

<br/>
<br/>
        <div class="container">
            <div class="row">
                <!-- Gestion des documents -->
                <div class="col-md-12 mb-4">
                    <div class="card shadow-sm text-center">
                        <div class="card-body">
                            <i class="bi bi-folder-fill fs-1 text-success"></i>
                            <h5 class="card-title mt-2">Gestion des documents</h5>
                            <a href="{{ route('dashboard') }}" class="btn btn-success">Accéder</a>
                        </div>
                    </div>
                </div>
                <!-- Gestion des demandes -->
                <div class="col-md-12">
                    <div class="card shadow-sm text-center">
                        <div class="card-body">
                            <i class="bi bi-file-earmark-text-fill fs-1 text-success"></i>
                            <h5 class="card-title mt-2">Services RH</h5>
                            <a href="{{ route('dashboardrh') }}" class="btn btn-success">Accéder</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br>
<br>
<br>
<br>
      <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-lg  logout form-control btn-dark text-white">Déconnexion <i class="bi bi-box-arrow-right"></i></button>
                    </form>

      </div>


    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
