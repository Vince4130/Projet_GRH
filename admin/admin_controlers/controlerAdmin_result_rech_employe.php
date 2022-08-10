<?php
@session_start();

// require ('./admin/admin_models/modelAdmin_rech_employe.php');

function resultRechEmploye()
{
    $mon_empl = $_SESSION['employes'];
    
    ///////////////////////////////////////////////////////////////////////////////////////////////
    ////    Gestion des pages
    ///////////////////////////////////////////////////////////////////////////////////////////////

    if(isset($_GET['page']) && !empty($_GET['page'])) {
        $page = $_GET['page'];
    } else {
        $page = 1;
    }

    $nbLignesPage = 10;
    $nbLignes     = count($mon_empl);
    // var_dump($nbLignes); die;
    if($nbLignes == 0) {
        $nbLignes = 1;
    }
    
    $mapage = new Pagination($page);
    
    $mapage->setNbPages($nbLignesPage, $nbLignes);
    $mapage->setRecords($nbLignes);
    $mapage->setNbLignesPages($nbLignesPage);

    require('./admin/admin_views/viewAdmin_result_rech_employes.php');
}