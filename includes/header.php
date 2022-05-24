<?php

session_start();

$adminConnecte = $_SESSION['adminConnecte'];
$userConnecte  = $_SESSION['userConnecte'];

$today = date('d-m-Y');

?>

<!DOCTYPE html>
<html lang="fr">

<head>

  <meta http-equiv="Content-Type" content="text/html" charset="utf-8" />

  <title>Projet GRH</title>
  <link rel="stylesheet" href="./css/monstyle.css">
  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.min.css" />
  <!-- <link type="text/css" rel="stylesheet" href="./css/bootstrap-datepicker3.css"> -->
  <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
  <script src="https://kit.fontawesome.com/c6ca3add98.js" crossorigin="anonymous"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="javascript/functions.js"></script>
  
</head>

<body>

<div class="banhead">
  <div class="image"></div>
  <div class="grh"><h5>GRH</h5><h5>Gestion des Ressources Humaines</h5></div>
</div>

<div class="baniere">
  
<?php if(!$adminConnecte) : ?>

  <?php if($userConnecte) : ?>

  <div class="banleft">
    
    <div class="dropdown">
      <a class="nav-link dropdown-toggle text-white" href="#" id="navbardrop" data-toggle="dropdown" text-white>Profil</a>
        <div class="dropdown-menu">
          <a class="dropdown-item" href="index.php?action=welcome">Accueil</a>
          <a class="dropdown-item" href="index.php?action=profil">Voir/Modifier</a>
          <a class="dropdown-item" href="index.php?action=logout">Déconnexion</a>
        </div>
    </div>

    <div class="dropdown">
      <a class="nav-link dropdown-toggle text-white" href="#" id="navbardrop" data-toggle="dropdown">Pointage</a>
        <div class="dropdown-menu">
          <a class="dropdown-item" href="index.php?action=pointage">Saisir Pointage</a>
          <a class="dropdown-item" href="index.php?action=histo_point">Historique</a>
        </div>
    </div>

    <div class="dropdown">
      <a class="nav-link dropdown-toggle text-white" href="#" id="navbardrop" data-toggle="dropdown">Absences</a>
        <div class="dropdown-menu">
          <a class="dropdown-item" href="index.php?action=absences">Saisir Demande Absences</a>
          <a class="dropdown-item" href="index.php?action=histo_abs">Historique</a>
        </div>
    </div>
    
    <a href="index.php?action=formulaire">Formulaire RH</a>
    
  </div>

  <div class="banright">
    <a href="index.php?action=logout">Déconnexion</a>
  </div>
  
  <?php else : ?>

    <div class="banleft">
      <a href="index.php?action=accueil">Accueil</a>
      <a href="index.php?action=connect">Se connecter</a>  
    </div>

    <div class="banright">
      <a href="index.php?action=registration">S'enregistrer</a>
      <a href="index.php?action=adminConnect">Espace RH</a>    
    </div>

  <?php endif; ?>

<?php else : ?>

  <div class="banleft">

    <div class="dropdown">
      <a class="nav-link dropdown-toggle text-white" href="#" id="navbardrop" data-toggle="dropdown" text-white>Employés</a>
        <div class="dropdown-menu">
          <a class="dropdown-item" href="index.php?action=adminAccueil">Liste</a>
          <a class="dropdown-item" href="index.php?action=seekEmp">Rechercher</a>
        </div>
    </div>

    <div class="dropdown">
      <a class="nav-link dropdown-toggle text-white" href="#" id="navbardrop" data-toggle="dropdown">Planning</a>
        <div class="dropdown-menu">
          <a class="dropdown-item" href="404.php">Administration</a>
          <a class="dropdown-item" href="404.php">Informatique</a>
        </div>
    </div>

    <div class="dropdown">
      <a class="nav-link dropdown-toggle text-white" href="#" id="navbardrop" data-toggle="dropdown">Demandes</a>
        <div class="dropdown-menu">
          <a class="dropdown-item" href="404.php">Absences</a>
          <a class="dropdown-item" href="index.php?action=modifPointage">Modifications</a>
        </div>
    </div>      
  </div>

  <div class="banright">
    <a href="index.php?action=logout">Déconnexion</a>
  </div>

  <?php endif; ?>

</div>
