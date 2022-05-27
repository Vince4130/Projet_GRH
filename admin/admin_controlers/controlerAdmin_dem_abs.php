<?php
session_start();

require ('./admin/admin_models/modelAdmin_dem_abs.php');

function validAbs()
{
    $req_dem_abs = getAllDemAbs();
    $tab_all_dem = $req_dem_abs->fetchAll(PDO::FETCH_ASSOC);
    
    if(isset($_POST['submit'])) {
        
        $demasbsid = intval($_POST['demabsid']);

        $action = $_POST['submit'];

        switch($action) {

            case 'Valider' :
                $etat          = "Acceptée";
                $req_valid_dem =  updateDemAbs($demasbsid, $etat);

                if($req_dem_abs) {
                    $erreur      = false;
                    $text_erreur = "La demande d'absence est actualisée";

                    $req_update_conges        = updateConges();
                    $req_update_droits_conges = updateDroitsConges();

                } else {
                    $erreur      = true;
                    $text_erreur = "La demande d'absence n'a pas été actualisée";
                }
            break;

            case 'Refuser' :
                $etat = "Refusée";
                $req_valid_dem =  updateDemAbs($demasbsid, $etat);

                if($req_dem_abs) {
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