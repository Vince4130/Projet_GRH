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

            case  'Valider' :
                $req_valid_dem =  updateDemAbs($demasbsid);
            break;

        }

       
        
    }

    require ('./admin/admin_views/viewAdmin_dem_abs.php');
}