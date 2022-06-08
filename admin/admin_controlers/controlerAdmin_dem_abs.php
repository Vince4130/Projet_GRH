<?php
session_start();

require ('./admin/admin_models/modelAdmin_dem_abs.php');

function validAbs()
{

    //Toutes les demandes d'absences en attente
    $req_dem_abs_att = getAllDemAbsAttente();
    $tab_all_dem = $req_dem_abs_att->fetchAll(PDO::FETCH_ASSOC);
    
    if(isset($_POST['submit'])) {
        
        $id       = (int)($_POST['demabsid']);
        $action   = $_POST['submit'];

        switch($action) {

            case 'Valider' :
                $etat          = "Acceptée";
                $req_valid_dem =  updateDemAbs($id, $etat);
               
                if($req_valid_dem) {
                    $erreur      = false;
                    $text_erreur = "La demande d'absence est actualisée au statut accepté";

                    $req_insert_conges = insertConges($id);

                    if($req_insert_conges) {
                        $text_erreur .= " , les congés sont validés";

                        $req_update_droits_conges = updateDroitsConges($id);

                        if($req_update_droits_conges) {
                            $text_erreur .= " ainsi que les droits";
                        } else {
                            $text_erreur .= " mais pas les droits";
                        }
                    } else {
                        $text_erreur .= " mais pas les congés et les droits";
                    } 
                    
                } else {
                    $erreur      = true;
                    $text_erreur = "La demande d'absence n'a pas été actualisée";
                }
            break;

            case 'Refuser' :
                $etat          = "Refusée";
                $req_refus_dem =  updateDemAbs($id, $etat);

                if($req_refus_dem) {
                    $erreur      = false;
                    $text_erreur = "La demande d'absence est actualisée au statut refusé";

                } else {
                    $erreur      = true;
                    $text_erreur = "La demande d'absence n'a pas été actualisée";
                }
            break;
        }
        
    }

    ///////////////////////////////////////////////////////////////////////////////////////////////
    ////    Gestion des pages
    ///////////////////////////////////////////////////////////////////////////////////////////////

    if(isset($_GET['page']) && !empty($_GET['page'])) {
        $page = $_GET['page'];
    } else {
        $page = 1;
    }

    $nbLignesPage = 10;
    $nbLignes     = count($tab_all_dem);
    
    $mapage = new Pagination($page);
    
    $mapage->setNbPages($nbLignesPage, $nbLignes);
    $mapage->setRecords($nbLignes);
    $mapage->setNbLignesPages($nbLignesPage);


    require ('./admin/admin_views/viewAdmin_dem_abs.php');
}