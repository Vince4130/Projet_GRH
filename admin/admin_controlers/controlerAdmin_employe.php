<?php
session_start();

require ('./admin/admin_models/modelAdmin_employe.php');

function employe()
{   
    $id = (int)($_GET['id']);
    $_SESSION['id_employe'] = $id;

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
    // echo "<pre>"; var_dump($detail_empl); die;

    require ('./admin/admin_views/viewAdmin_employe.php');
}