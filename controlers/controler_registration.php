<?php

session_start();

require('../models/model.php');

include_once('../includes/inc_functions.php');

// $exist = false;

if (isset($_POST['submit'])) {

  $submit = $_POST['submit'];

  switch ($submit) {
       
    case "Effacer":
      $nom = "";
      $prenom = "";
      $mail = "";
      $ident = "";
      $passwd = "";
      $color = "black";
    break;

    case "Valider":

      if (isset($_POST['nom']) && isset($_POST['prenom']) && (isset($_POST['mail']))
            && isset($_POST['ident']) && isset($_POST['passwd']) && isset($_POST['horaire'])) {
        
        $exist = false;

        /////////////////////////////
        //Récupération des données 
        ////////////////////////////

        $nom = htmlspecialchars(trim($_POST['nom']));
        $prenom = htmlspecialchars(trim($_POST['prenom']));
        $mail = filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL);
        $ident = htmlspecialchars(trim($_POST['ident']));
        $passwd = $_POST['passwd'];
        $horaire = (int) ($_POST['horaire']);
        
        if (!empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['mail']) && !empty($_POST['ident']) && !empty($_POST['passwd']) && !empty($_POST['horaire'])) {

          ///////////////////////////////////////////////////////////////
          //Vérification existence du mail et/ou idenfiant dans la base
          //////////////////////////////////////////////////////////////
    
          $req_exist = userMailIdent($mail, $ident);
          
          $rows = $req_exist->rowCount();

          $tabresult = $req_exist->fetch(PDO::FETCH_ASSOC);
          
          if ($rows == 1) {

            if($tabresult['email'] == $mail) {
              $exist = true;
              $text_erreur = "Cette adresse email est déjà utilisée";
              $mail = "";
            } elseif ($tabresult['ident'] == $ident) {
                $exist = true;
                $text_erreur = "Cet identifiant est déjà utilisé";
                $ident = "";
                }
          }
          
          ///////////////////////////////////////////////////////////////
          //Enregistrement de l'employe dans la base de donnée
          ///////////////////////////////////////////////////////////////
          
          if(!$exist) {

            $req_registration = userRegistration($nom, $prenom, $mail, $ident, $passwd, $horaire);
                  
            $row = $req_registration->rowCount();

              if ($row != 1) {
                $erreur = true;
                $text_erreur = "Votre enregistrement a échoué";
              } else {
                  $text_erreur = "Vous êtes enregistré(e) sur le site Vous pouvez vous connecter";
                  $bdd = null;
                }
          }

        } else {
            $erreur = true;
            $text_erreur = "Veuillez remplir tous les champs";
          }
        }
      break;
  }
}

require('../views/view_registration.php');