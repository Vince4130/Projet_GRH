<?php
session_start();

require ('./admin/admin_models/modelAdmin_employe.php');

function employe()
{   
    
    $id = (int)($_GET['id']);

    //  /////////////////////////////////
    // //Mise à jour du profil
    // ////////////////////////////////
    if (isset($_POST['submit'])) {
       
        $action = $_POST['submit'];

        if ($action === "Retour") {  
            // if(!empty($_SESSION['id_employe'])) {
            //     $_SESSION['id_employe'] = "";
            // }
            header('Location: index.php?action=adminAccueil');
        } 
        
        $id_employe = $_POST['empid'];
        $_SESSION['id_employe'] = $id_employe;
        $profil     = getProfil($id_employe);
        $emp_profil = $profil->fetch(PDO::FETCH_ASSOC);
        // echo "<pre>"; var_dump($emp_profil); die;
        $emp_fonct  = intval($emp_profil['fonctid']);
        $emp_serv   = intval($emp_profil['servid']);
        $emp_hor    = intval($emp_profil['horid']);
        
        $fonction = filter_input(INPUT_POST, 'fonction', FILTER_VALIDATE_INT);
        $service  = filter_input(INPUT_POST, 'service', FILTER_VALIDATE_INT);
        $horaire  = filter_input(INPUT_POST, 'horaire', FILTER_VALIDATE_INT);
        
        if ($fonction !== $emp_fonct OR $service !== $emp_serv OR $horaire !== $emp_hor) {

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
    
    // if (!empty($erreur)) {

    //     $erreur = (int)$_GET['erreur'];

    //     if ($erreur === 1)  {
    //         $erreur = false;
    //     }
    //     else {
    //         $erreur = true;
    //     }
    // }

    // if (!empty($text_erreur)) {
    //     $text_erreur = $_GET['text_erreur'];
    // } 
   
    $employe = getEmploye($id);

    $detail_empl = $employe->fetch(PDO::FETCH_ASSOC);

    $horid  = $detail_empl['horid'];
    
    $_SESSION['fonctid'] = (int)($detail_empl['fonctid']);
    $_SESSION['servid']  = (int)($detail_empl['servid']);
    $_SESSION['horid']   = (int)($detail_empl['horid']);

    $mod_horaire = getModuleHoraire($id, $horid); 
 
    $horaire = $mod_horaire->fetch(PDO::FETCH_ASSOC);
    // var_dump($detail_empl['horid']);
    $fonctions = getListFonctions();
    $services  = getListServices();
    
    $solde_conges    = getSoldeAbsences($id, 1);
    $solde_formation = getSoldeAbsences($id, 2);
   
    $anciennete = $detail_empl['anciennete'];
    
    if($anciennete < 12) {
        $mois = $anciennete;
        $anciennete = $mois." mois";
    } 

    if($anciennete >= 12) {
        $an   = floor($anciennete/12);
        $mois = $anciennete%12;
        if($an == 1) {
            if($mois > 0) {
                $anciennete = $an." an et ".$mois." mois";
            } else {
                $anciennete = $an." an";
            }
        } else {
            if($mois > 0) {
                $anciennete = $an." ans et ".$mois." mois";
            } else {
                $anciennete = $an." ans";
            }
        }
    }

    // if ($update_employe !== 1) {
    //     $erreur = true;
    //     $text_erreur  = "Pas de mise à jour";
    // } else {
    //     $erreur = false;
    //     $text_erreur  = "Mise à jour du profil de l'employé";
    // }
    //  echo "<pre>"; var_dump($text_erreur); die;

    require ('./admin/admin_views/viewAdmin_employe.php');
}