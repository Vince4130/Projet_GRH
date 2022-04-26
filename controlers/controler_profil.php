<?php

session_start();

require('../models/model.php');

include_once('../includes/inc_functions.php');

$id = $_SESSION['id'];

/////////////////////////////////
//Mise à jour du profil
////////////////////////////////
if (isset($_POST['submit'])) {

    //Récupération des valeurs des variables issues du formulaire
    //sinon des valeurs des variables de sessions lors de la connexion
    //dans controler_connect.php
    if (isset($_POST['mail']) && $_POST['mail'] != $_SESSION['email']) {
        $mail = filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL);
    } else {
        $mail = $_SESSION['email'];
    }

    if (isset($_POST['passwrd']) && $_POST['passwrd'] != $_SESSION['mdpass']) {
        $pass = htmlspecialchars(trim($_POST['passwrd']));
    } else {
        $pass = $_SESSION['mdpass'];
    }

    if (isset($_POST['horaire']) && $_POST['horaire'] != $_SESSION['horid']) {
        $horaire = horaireId($_POST['horaire']);
    } else {
        $horaire = $_SESSION['horid'];
    }

    //Requête de mise à jour du profil
    $update_profil = updateProfil($mail, $pass, $horaire, $id);

    // var_dump($update_profil); die;
    
    if ($update_profil !== 1) {
        $echec = true;
        $text = "Pas de mise à jour";
    } else {
        $echec = false;
        $text = "Mise à jour de vos informations";      
    }

    $bdd = NULL;
}


//////////////////////////////////////////////
//Récupération du profil et du module horaire
/////////////////////////////////////////////
$req_profil = getProfil($id);

$employe = $req_profil->fetch(PDO::FETCH_ASSOC);

$horid = $employe['horid'];

$mod_horaire = getModuleHoraire($id, $horid);

$result = $mod_horaire->fetch(PDO::FETCH_ASSOC);

$horaire_empl = substr($result['hormod'],0,5);

require('../views/view_profil.php');
