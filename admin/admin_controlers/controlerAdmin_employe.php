<?php
@session_start();

require ('./admin/admin_models/modelAdmin_employe.php');

function employe()
{   
    
    $id = (int)($_GET['id']);

    ///////////////////////////////////
    ////Mise à jour du profil
    //////////////////////////////////
    if (isset($_POST['submit'])) {
       
        $action = $_POST['submit'];

        if ($action === "Retour") {  
            header('Location: index.php?action=listeEmployes');
            exit();
        }

        $id_employe = $_POST['empid'];
        $_SESSION['id_employe'] = $id_employe;
        
        $profil     = getProfil($id_employe);
        $emp_profil = $profil->fetch(PDO::FETCH_ASSOC);
       
        $emp_fonct  = intval($emp_profil['fonctid']);
        $emp_serv   = intval($emp_profil['servid']);
        $emp_hor    = intval($emp_profil['horid']);
        
        $fonction = filter_input(INPUT_POST, 'fonction', FILTER_VALIDATE_INT);
        $service  = filter_input(INPUT_POST, 'service', FILTER_VALIDATE_INT);
        $horaire  = filter_input(INPUT_POST, 'horaire', FILTER_VALIDATE_INT);

        if(is_null($fonction)) {
            $fonction = $emp_fonct;
        } 

        if ($fonction !== $emp_fonct OR $service !== $emp_serv OR $horaire !== $emp_hor) {

            $erreur      = false;
            $text_erreur = "";

            $update_employe = updateEmploye($service, $fonction, $horaire, $id_employe);
            
            $update = $update_employe->rowCount();

            if ($update === 1) {
                $erreur      = false;
                $text_erreur = "Le profil de l'employé a été mis à jour";
            } else {
                $erreur      = true;
                $text_erreur = "Une erreur a empéché la mise à jour du profil de l'employé";
            }
        } else {
            $erreur      = true;
            $text_erreur = "Aucune modification du profil";
        }
        
    }
   
    //Recupération profil d'un employé à partir de son id
    $employe = getEmploye($id);

    $detail_empl = $employe->fetch(PDO::FETCH_ASSOC);

    $horid  = $detail_empl['horid'];
    
    $_SESSION['fonctid'] = (int)($detail_empl['fonctid']);
    $_SESSION['servid']  = (int)($detail_empl['servid']);
    $_SESSION['horid']   = (int)($detail_empl['horid']);

    $mod_horaire = getModuleHoraire($id); //getModuleHoraire($id, $horid)
 
    $horaire = $mod_horaire->fetch(PDO::FETCH_ASSOC);
    
    $fonctions = getListFonctions();
    $services  = getListServices();
    
    $listeLibServices = servicesLibelle($services);

    //Fonctions déclarées dans modelAdmin_creer_employe
    $fonctionsAd   = getFonctionsService(1);
    $fonctionsInfo = getFonctionsService(2);
    $horaires      = getHoraires();

    $solde_conges      = getSoldeAbsences($id, 1);
    $solde_formation   = getSoldeAbsences($id, 2);
    $solde_teletravail = getSoldeAbsences($id, 3);
   
    $anciennete = $detail_empl['anciennete'];
    
    //Mise en forme de l'affichage de l'ancienneté de l'employé (année mois)
    if($anciennete < 12) {
        $mois = $anciennete;
        $anciennete_employe = $mois." mois";
    } 

    if($anciennete >= 12) {
        $an   = floor($anciennete/12);
        $mois = $anciennete%12;
        if($an == 1) {
            if($mois > 0) {
                $anciennete_employe = $an." an et ".$mois." mois";
            } else {
                $anciennete_employe = $an." an";
            }
        } else {
            if($mois > 0) {
                $anciennete_employe = $an." ans et ".$mois." mois";
            } else {
                $anciennete_employe = $an." ans";
            }
        }
    }

    require ('./admin/admin_views/viewAdmin_employe.php');
}