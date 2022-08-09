<?php
@session_start();

require ('./models/model_consult_dem_abs.php');

function consultDemAbs()
{
    $id = $_SESSION['id'];

    $req_dem_abs = getDemAbsUser($id);

    $dem_abs = $req_dem_abs->fetchAll(PDO::FETCH_ASSOC);
    // foreach($dem_abs as $dem) {
    //     echo "<pre>"; var_dump($dem);
    // }
    // echo "<pre>"; var_dump($dem_abs); die;
    //Suppression demande 
    if(isset($_POST['submit'])) {
        
        if($_POST['abs_id']) {

            $abs_id = (int)($_POST['abs_id']);
            
            $req_delete_dem = deleteDemAbs($abs_id);

            if($req_delete_dem) {
                $erreur      = false;
                $text_erreur = "Votre demande a été supprimée";
            } else {
                $erreur      = true;
                $text_erreur = "Votre demande n'a pas été supprimée";
            }

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
    $nbLignes     = count($dem_abs);
    
    if($nbLignes == 0) {
        $nbLignes = 1;
    }
    
    $mapage = new Pagination($page);
    
    $mapage->setNbPages($nbLignesPage, $nbLignes);
    $mapage->setRecords($nbLignes);
    $mapage->setNbLignesPages($nbLignesPage);

    require('./views/view_consult_dem_abs.php');
}
