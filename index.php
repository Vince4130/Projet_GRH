<?php

require('./controlers/controler.php');
require('./controlers/controler_connect.php');
require('./controlers/controler_welcome.php');
require('./controlers/controler_registration.php');
require('./controlers/controler_profil.php');
require('./controlers/controler_histo_point.php');
require('./controlers/controler_pointage.php');
require('./controlers/controler_resultats.php');
require('./controlers/controler_dem_modif_point.php');

require('./admin/admin_controlers/controlerAdmin_connect.php');
require('./admin/admin_controlers/controlerAdmin_modif_point.php');
require('./classes/connexionDB.class.php');
// require('./admin/admin_controlers/controlerAdmin_accueil.php');
// $origine = str_replace(dirname($_SERVER['PHP_SELF']), '', $_SERVER['REQUEST_URI']);
$instance = ConnexionDB::getInstance();
$bdd = $instance->getConnection();

global $bdd;

if (isset($_GET['action'])) {
    $action = $_GET['action'];
} else {
    $action = 'accueil';
}

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

    case 'demModifPoint' :
        demModifPoint();//formulaire();
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

    case 'employe' :
        if (isset($_GET['id'])) {
            employe();
        }
    break;

    case 'modifPointage' :
        listeModifPointage();
    break;

    case 'consultModif' :
        getModifPointage();
    break;

    // case 'validModif' :
    //     validModifPointage();

    default :
        header('Location: 404.php');
        exit();
}

