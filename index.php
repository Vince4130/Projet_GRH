<?php

require('./controlers/controler.php');
require('./admin/admin_controlers/controlerAdmin_connect.php');
// require('./admin/admin_controlers/controlerAdmin_accueil.php');
// $origine = str_replace(dirname($_SERVER['PHP_SELF']), '', $_SERVER['REQUEST_URI']);

if (isset($_GET['action'])) {

    $action = $_GET['action'];

    switch($action) {

        case 'accueil' :
            accueil();
        break;

        case 'connect' :
            userConnection();
        break;

        case 'welcome' :
            welcome();
        break;

        case 'profil' :
            userProfil();
        break;

        case 'logout' :
            logout();
        break;

         case 'histo_point' :
            historiquePointage();
        break;

        case 'registration' :
            userInscription();
        break;

        case 'pointage' :
            pointage();
        break;

        case 'resultats' :
            resultPointage();
        break;

        case 'formulaire' :
            formulaire();
        break;

        case 'absences' :
            saisieDemandeAbsence();
        break;

        case 'adminConnect' :
            adminConnection();
        break;

        case 'adminAccueil' :
            adminAccueil();
        break;

        case "employe" :
            if (isset($_GET['id'])) {
                employe();
            }
        break;

        default :
            accueil();
    }
} else {
    accueil();
}
