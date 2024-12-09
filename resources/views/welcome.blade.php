<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Formulaire de Connexion</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <div class="container-fluid vh-100 d-flex w-100 ">
    <div class="row w-100  rounded">
      <!-- Colonne gauche : texte et logo -->
      <div class="col-md-6 d-flex flex-column  " style="background-color:#038C4F; padding:60px;color:white;">
        <img src="logobg.png" alt="Logo" class="mb-4" style="width: 360px;">
<div style="height:350px"></div>
        <h2 class="text-left">BIENVENUE SUR LA PLATEFORME  DE GESTION DE FICHIER </h2>
        <p class="text-lfet text-muted">Connectez-vous pour accéder à votre espace personnel.</p>
      </div>
      <!-- Colonne droite : formulaire -->
      <div class="col-md-6 bg-white " style="padding-left:100px;padding-right:100px;padding-top:260px;">
        <h3 class="text-center mb-4">Connexion</h3>
        <form action="{{ route('dashboard') }}" method="GET">
          <div class="mb-3">
            <label for="email" class="form-label">Adresse email</label>
            <input type="email" class="form-control" id="email" placeholder="Entrez votre email" >
          </div>
          <div class="mb-3">
            <label for="password" class="form-label">Mot de passe</label>
            <input type="password" class="form-control" id="password" placeholder="Entrez votre mot de passe" >
          </div>
          <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="rememberMe">
            <label class="form-check-label" for="rememberMe">Se souvenir de moi</label>
          </div>
          <button type="submit" class="btn  w-100" style="background-color:#038C4F;color:white;">Se connecter</button>
      
        </form>
      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
