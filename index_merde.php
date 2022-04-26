<?php

require('./controlers/controler.php');
require('./admin/admin_controlers/controlerAdmin_connect.php');
// require('./admin/admin_controlers/controlerAdmin_accueil.php');
// $origine = str_replace(dirname($_SERVER['PHP_SELF']), '', $_SERVER['REQUEST_URI']);

if (isset($_GET['action'])) {

    // $action = $_GET['action'];

    if($_GET['action'] == 'accueil') {
        accueil();
    } 
    
    elseif($_GET['action'] == 'connect') {
        userConnection();
    }

    elseif($_GET['action'] == 'welcome') {
        welcome();
    }
    
    elseif($_GET['action'] == 'profil') {
        userProfil();
    }

    elseif($_GET['action'] == 'logout') {
        logout();
    }

    elseif($_GET['action'] == 'histo_point') {
        historiquePointage();
    }

    elseif($_GET['action'] == 'histo_point') {
        historiquePointage();
    }

    elseif($_GET['action'] == 'registration') {
        userInscription();
    }

    elseif($_GET['action'] == 'pointage') {
        pointage();
    }

    elseif($_GET['action'] == 'resultats') {
        resultPointage();
    }

    elseif($_GET['action'] == 'formulaire') {
        formulaire();
    }

    elseif($_GET['action'] == 'absences') {
        saisieDemandeAbsence();
    }

    elseif($_GET['action'] == 'adminConnect') {
        adminConnection();
    }

    elseif($_GET['action'] == 'adminAccueil') {
        adminAccueil();
    }

    elseif($_GET['action'] == 'employe') {
            employe();
    }
}
