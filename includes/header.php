<?php
session_start();

if(isset($_SESSION['adminConnecte'])) {
  $adminConnecte = $_SESSION['adminConnecte'];
} else {
  $_SESSION['adminConnecte'] = false;
  //$adminConnecte = false;
}

if(isset($_SESSION['userConnecte'])) {
  $userConnecte  = $_SESSION['userConnecte'];
} else {
  $_SESSION['userConnecte'] = false;
  //$userConnecte  = false;
}

$today = date('d-m-Y');

?>

<!DOCTYPE html>
<html lang="fr">

<head>

  <meta http-equiv="Content-Type" content="text/html" charset="utf-8" />

  <title>Projet GRH</title>
  <link rel="stylesheet" href="./css/monstyle.css" />
  <link rel="stylesheet" href="./css/laptop.css" media="screen and (max-width:1280px)" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.min.css" />
  <!-- <link type="text/css" rel="stylesheet" href="./css/bootstrap-datepicker3.css"> -->
  <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  
  <script src="./javascript/functions.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
  <script src="https://kit.fontawesome.com/c6ca3add98.js" crossorigin="anonymous"></script>
  <script src="js/bootstrap.min.js"></script>
  
  
  <script>
      /**
       * Decompte de secondes avant redirection
       * vers une autre page
       * @param mixed text
       * @param mixed sec
       * 
       * @return [type]
       */
      function decompte(text, sec) {     
          if (sec > 0) {
              document.getElementById("succes").innerHTML = text+' redirection dans '+sec+'s';
              setInterval(() => {
                  --sec;        
                  decompte();
                  document.getElementById("succes").innerHTML = text+' redirection dans '+sec+'s';
              }, 1000);
          } 
      }
  </script>
  
</head>

<body>

<div class="banhead">
  <div class="image"></div>
  <div class="grh"><h5>GRH Gestion des Ressources Humaines</h5></div>
</div>

<div class="baniere">
  
<?php if(!$adminConnecte) : ?>

  <?php if($userConnecte) : ?>

    <div class="banleft">
    <a href="index.php?action=welcome">Accueil</a>
      <div class="dropdown">
        <a class="nav-link dropdown-toggle text-white" href="#" id="navbardrop" data-toggle="dropdown" text-white>Profil</a>
          <div class="dropdown-menu">
            <a class="dropdown-item" href="index.php?action=welcome">Accueil</a>
            <a class="dropdown-item" href="index.php?action=profil">Consulter/Modifier</a>
            <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#aurevoir">Déconnexion</a>
          </div>
      </div>

      <div class="dropdown">
        <a class="nav-link dropdown-toggle text-white" href="#" id="navbardrop" data-toggle="dropdown">Pointage</a>
          <div class="dropdown-menu">
            <a class="dropdown-item" href="index.php?action=pointage">Saisie</a>
            <a class="dropdown-item" href="index.php?action=histo_point">Historique</a>
          </div>
      </div>

      <div class="dropdown">
        <a class="nav-link dropdown-toggle text-white" href="#" id="navbardrop" data-toggle="dropdown">Absences</a>
          <div class="dropdown-menu">
            <a class="dropdown-item" href="index.php?action=absences">Saisie</a>
            <a class="dropdown-item" href="index.php?action=consultDemAbs">Liste demandes</a>
            <a class="dropdown-item" href="index.php?action=histoAbsences">Historique</a>
            <a class="dropdown-item" href="index.php?action=planning">Planning</a>
          </div>
      </div>
      
      <a href="index.php?action=formulaire">Formulaire RH</a>
      
    </div>

    <div class="banright">
      <a href="#" data-bs-toggle="modal" data-bs-target="#aurevoir">Déconnexion</a>
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
    
    <a href="index.php?action=adminAccueil">Accueil</a>
    
    <div class="dropdown">
      <a class="nav-link dropdown-toggle text-white" href="#" id="navbardrop" data-toggle="dropdown" text-white>Employés</a>
        <div class="dropdown-menu">
          <a class="dropdown-item" href="index.php?action=listeEmployes">Liste des employés</a>
          <a class="dropdown-item" href="index.php?action=rechEmploye">Rechercher un employé</a>
          <a class="dropdown-item" href="index.php?action=creerEmploye">Enregistrer un nouvel employé</a>
          <!-- <a class="dropdown-item" href="index.php?action=supprEmploye">Supprimer un employé</a> -->
        </div>
    </div>

    <div class="dropdown">
      <a class="nav-link dropdown-toggle text-white" href="#" id="navbardrop" data-toggle="dropdown" text-white>Services</a>
        <div class="dropdown-menu">
          <a class="dropdown-item" href="index.php?action=listeEmployesAd">Administratif</a>
          <a class="dropdown-item" href="index.php?action=listeEmployesInfo">Informatique</a>
        </div>
    </div>

    <div class="dropdown">
      <a class="nav-link dropdown-toggle text-white" href="#" id="navbardrop" data-toggle="dropdown">Planning</a>
        <div class="dropdown-menu">
          <a class="dropdown-item" href="index.php?action=planningGeneral">Général</a>
          <a class="dropdown-item" href="index.php?action=planningAdministratif">Administration</a>
          <a class="dropdown-item" href="index.php?action=planningInformatique">Informatique</a>
        </div>
    </div>

    <div class="dropdown">
      <a class="nav-link dropdown-toggle text-white" href="#" id="navbardrop" data-toggle="dropdown">Demandes en attente</a>
        <div class="dropdown-menu">
          <a class="dropdown-item" href="index.php?action=validAbs">Absences</a>
          <a class="dropdown-item" href="index.php?action=modifPointage">Modifications de pointage</a>
        </div>
    </div>      
  </div>

  <div class="banright">
  <div class="dropdown">
      <a class="nav-link dropdown-toggle text-white" href="#" id="navbardrop" data-toggle="dropdown">Espace RH</a>
        <div class="dropdown-menu">
          <a class="dropdown-item" href="index.php?action=listeRH">Liste des responsables RH</a>
          <a class="dropdown-item" href="index.php?action=creerRH">Enregistrer un responsable RH</a>     
        </div>
    </div>      
    <a href="#" data-bs-toggle="modal" data-bs-target="#aurevoir">Déconnexion</a>  
  </div>

  <?php endif; ?>

</div>


<!-- Modal Bootstrap pour la déconnexion -->
<div class="modal fade" id="aurevoir" tabindex="-1"  aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Au revoir</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <p><?= $_SESSION['prenom']." ".$_SESSION['nom'] ?></p>
          </div>
          <form action="index.php?action=logout" method="post">
            <div class="modal-footer">
              <input type="button" class="btn btn-primary" data-bs-dismiss="modal" value="Retour" />
              <input type="submit" class="btn btn-primary" name="submit" value="Valider" />
              <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary">Save changes</button> -->
            </div>
          </form>
        </div>
    </div>
</div>