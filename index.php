<?php

require('./controlers/controler_connect.php');
require('./controlers/controler_welcome.php');
require('./controlers/controler_registration.php');
require('./controlers/controler_profil.php');
require('./controlers/controler_histo_point.php');
require('./controlers/controler_pointage.php');
require('./controlers/controler_resultats.php');
require('./controlers/controler_dem_modif_point.php');
require('./controlers/controler_dem_abs.php');
require('./controlers/controler_logout.php');
require('./controlers/controler_accueil.php');
require('./controlers/controler_forgot_pwd.php');
require('./controlers/controler_reinit_pwd.php');
require('./controlers/controler_consult_dem_abs.php');
require('./controlers/controler_histo_abs.php');
require('./controlers/controler_planning.php');

require('./admin/admin_controlers/controlerAdmin_connect.php');
require('./admin/admin_controlers/controlerAdmin_modif_point.php');
require('./admin/admin_controlers/controlerAdmin_employe.php');
require('./admin/admin_controlers/controlerAdmin_liste_employes.php');
require('./admin/admin_controlers/controlerAdmin_liste_employes_ad.php');
require('./admin/admin_controlers/controlerAdmin_liste_employes_info.php');
require('./admin/admin_controlers/controlerAdmin_creer_employe.php');
require('./admin/admin_controlers/controlerAdmin_dem_abs.php');
require('./admin/admin_controlers/controlerAdmin_rech_employe.php');
require('./admin/admin_controlers/controlerAdmin_result_rech_employe.php');
require('./admin/admin_controlers/controlerAdmin_creer_rh.php');
require('./admin/admin_controlers/controlerAdmin_liste_rh.php');
require('./admin/admin_controlers/controlerAdmin_planning_gal.php');
require('./admin/admin_controlers/controlerAdmin_planning_ad.php');
require('./admin/admin_controlers/controlerAdmin_planning_inf.php');

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

    case "forgotPwd" :
        forgotPwd();
        break;

    case "reinitPwd" :
        reinitPwd();
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
        demModifPoint();
    break;

    case 'absences' :
        saisieDemandeAbsence();
    break;

    case 'consultDemAbs' :
        consultDemAbs();
    break;

    case 'histoAbsences' :
        histoAbsences();
    break;

    case 'planning' :
        planning();
    break;

    case 'adminConnect' :
        adminConnection();
    break;

    case 'adminAccueil' :
        adminAccueil();
    break;

    case 'employe' :
        employe();
    break;

    case 'listeEmployes' :
        listeEmployes();
    break;

    case 'listeEmployesAd' :
        listeEmployesAd();
    break;

    case 'listeEmployesInfo' :
        listeEmployesInfo();
    break;

    case 'creerEmploye' :
        creerEmploye();
    break;

    case 'rechEmploye' :
        rechEmploye();
    break;

    case 'resultRechEmploye' :
        resultRechEmploye();
    break;

    case 'creerRH' :
        creerRH();
    break;

    case 'listeRH' :
        listeRH();
    break;

    case 'modifPointage' :
        listeModifPointage();
    break;

    case 'consultModif' :
        getModifPointage();
    break;

    case 'validAbs' :
        validAbs();
    break;

    case 'planningGeneral' :
        planningGeneral();
    break;

    case 'planningAdministratif' :
        planningAdministratif();
    break;

    case 'planningInformatique' :
        planningInformatique();
    break;

    default :
        header('Location: 404.php');
        exit();
}

