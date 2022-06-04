<?php
session_start();

require ('./admin/admin_models/modelAdmin_employe.php');

function employe()
{   
    $id = (int)($_GET['id']);
    $_SESSION['id_employe'] = $id;
    
    if (!empty($erreur)) {

        $erreur = (int)$_GET['erreur'];
        if ($erreur == 1)  {
            $erreur = false;
        }
        else {
            $erreur = true;
        }
    }

    if (!empty($text_erreur)) {
        $text_erreur = $_GET['text_erreur'];
    } 
    
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

    if ($update_employe !== 1) {
        $erreur = true;
        $text_erreur  = "Pas de mise à jour";
    } else {
        $erreur = false;
        $text_erreur  = "Mise à jour du profil de l'employé";
    }
    //  echo "<pre>"; var_dump($text_erreur); die;

    require ('./admin/admin_views/viewAdmin_employe.php');
}