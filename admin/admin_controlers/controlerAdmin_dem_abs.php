<?php
session_start();

require ('./admin/admin_models/modelAdmin_dem_abs.php');

function validAbs()
{
    $req_dem_abs = getAllDemAbs();
    $tab_all_dem = $req_dem_abs->fetchAll(PDO::FETCH_ASSOC);
    
    if(isset($_POST['submit'])) {
        
        $id       = (int)($_POST['demabsid']);
        $action   = $_POST['submit'];

        switch($action) {

            case 'Valider' :
                $etat          = "Acceptée";
                $req_valid_dem =  updateDemAbs($id, $etat);
               
                if($req_valid_dem) {
                    $erreur      = false;
                    $text_erreur = "La demande d'absence est actualisée";

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
                    $text_erreur = "La demande d'absence est actualisée";

                } else {
                    $erreur      = true;
                    $text_erreur = "La demande d'absence n'a pas été actualisée";
                }
            break;
        }

       
        
    }

    require ('./admin/admin_views/viewAdmin_dem_abs.php');
}