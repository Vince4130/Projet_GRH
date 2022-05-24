<?php
session_start();

require('./models/model_profil.php');
include_once('./includes/inc_functions.php');

function userProfil()
{

    $id = $_SESSION['id'];
    
    /////////////////////////////////
    //Mise à jour du profil
    ////////////////////////////////
    if (isset($_POST['submit'])) {

        //Récupération des valeurs des variables issues du formulaire
        //sinon valeurs des variables de session lors de la connexion
        //dans controler_connect.php
        if (isset($_POST['mail']) && $_POST['mail'] != $_SESSION['email']) {
            $mail = filter_input(INPUT_POST, 'mail', FILTER_SANITIZE_EMAIL);
        } else {
            $mail = $_SESSION['email'];
        }

        if (isset($_POST['passwrd']) && $_POST['passwrd'] != $_SESSION['mdpass']) {
            $pass = filter_input(INPUT_POST, 'passwrd', FILTER_SANITIZE_SPECIAL_CHARS);
        } else {
            $pass = $_SESSION['mdpass'];
        }

        // if (isset($_POST['horaire']) && $_POST['horaire'] != $_SESSION['horid']) {
        //     $horaire = horaireId($_POST['horaire']);
        // } else {
        //     $horaire = $_SESSION['horid'];
        // }

        //Requête de mise à jour du profil
        $update_profil = updateProfil($mail, $pass, $id); //$horaire, 

        if ($update_profil !== 1) {
            $echec = true;
            $text  = "Pas de mise à jour";
        } else {
            $echec = false;
            $text  = "Mise à jour de vos informations";
        }

        $bdd = null;
    }

    //////////////////////////////////////////////
    //Récupération du profil et du module horaire
    /////////////////////////////////////////////

    if(!empty($id)) {

        $req_profil = getProfil($id);

        $employe = $req_profil->fetch(PDO::FETCH_ASSOC);

        $horid    = $employe['horid'];
        $servid   = $employe['servid'];
        $fonctid  = $employe['fonctid'];
        $embauche = $employe['dateEmbauche']; 

        $mod_horaire = getModuleHoraire($id, $horid);
        $service     = getService($servid);
        $fonction    = getFonction($fonctid);
        $anciennete  = getAnciennete($id);
     
        $user_schedule   = $mod_horaire->fetch(PDO::FETCH_ASSOC);
        $user_service    = $service->fetch(PDO::FETCH_ASSOC);
        $user_fonction   = $fonction->fetch(PDO::FETCH_ASSOC);
        $user_anciennete = $anciennete->fetch(PDO::FETCH_ASSOC);
      
        $horaire_empl     = $user_schedule['Mod_Hor'];
        $service_empl     = $user_service['libelle'];
        $fonction_empl    = $user_fonction['libelle'];
        $anciennete_empl  = $user_anciennete['anciennete'];
        
        require('./views/view_profil.php');

    } else {
        header('Location: index.php?action=accueil');
        exit();
    }
}