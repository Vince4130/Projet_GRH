<?php
require ('./admin/admin_models/modelAdmin_modif_point.php');
include_once('includes/inc_functions.php');

/**
 * Retourne 
 * la liste des demandes de modifications
 * de pointage de l'ensemble des employés
 * @return [type]
 */
function listeModifPointage() 
{

    $req_list_modif_point = getAllModifPointage();

    $listModifPoint = $req_list_modif_point->fetchAll(PDO::FETCH_ASSOC);

    // $nblignes = count($listModifPoint);

    ///////////////////////////////////////////////////////////////////////////////////////////////
    ////    Gestion des pages
    ///////////////////////////////////////////////////////////////////////////////////////////////

    if(isset($_GET['page']) && !empty($_GET['page'])) {
        $page = $_GET['page'];
    } else {
        $page = 1;
    }

    $nbLignesPage = 10;
    $nbLignes     = count($listModifPoint);

    if($nbLignes == 0) {
        $nbLignes = 1;
    }
    
    $mapage = new Pagination($page);
    
    $mapage->setNbPages($nbLignesPage, $nbLignes);
    $mapage->setRecords($nbLignes);
    $mapage->setNbLignesPages($nbLignesPage);
    
    require ('./admin/admin_views/viewAdmin_modif_point.php');
}

/**
 * @return [type]
 */
function getModifPointage()
{
    $dempointid = (int)($_GET['dempointid']);
    
    $req_pointage = getPointageDem($dempointid);

    $req_demande = getDemande($dempointid);

    $pointage =  $req_pointage->fetch(PDO::FETCH_ASSOC);
    
    $demande = $req_demande->fetch(PDO::FETCH_ASSOC);

    if(isset($_POST['submit'])) {

        $action = $_POST['submit'];

        $pointid = (int)($_POST['pointage']);
        $demid   = (int)($_POST['demande']);
        
        if($action == "Valider") {
            
            $ha      = $_POST['ham'];
            $pm1     = $_POST['pm1m'];
            $pm2     = $_POST['pm2m'];
            $hd      = $_POST['hdm'];
            
            $decision    = "Acceptée";
            $text_erreur = "";
            
            $req_update_pointage = updatePointage($pointid, $ha, $pm1, $pm2, $hd);
            
            if($req_update_pointage) {           
                $erreur        = false;
                $text_erreur   = "Le pointage a été modifié"; 
                
                $req_update_demande = updateDemande($demid, $decision, $pointid);

                if($req_update_demande) {
                    $text_erreur .= " et la demande actualisée";
                } else {
                    $text_erreur .= " mais la demande n'a pas été actualisée";
                }
                

            } else {
                $erreur        = true;
                $text_erreur   = "Le pointage n'a pas été modifié";
            }
        }

        if($action == "Refuser") {

            $decision = "Refusée";

            $req_update_demande = updateDemande($demid, $decision, $pointid);

            if($req_update_demande) {
                $erreur      = false;
                $text_erreur = "La demande est actualisée";
            } else {
                $erreur      = true;
                $text_erreur = "La demande n'a pas été actualisée";
            }
        }
    }

    require ('./admin/admin_views/viewAdmin_decision_modif_point.php'); 
}
