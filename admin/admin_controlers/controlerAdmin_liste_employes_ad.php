<?php
session_start();

require ('./admin/admin_models/modelAdmin_liste_employes_ad.php');

function listeEmployesAd()
{
    
    $liste_employes_ad = getEmployesAdministratif();

    ///////////////////////////////////////////////////////////////////////////////////////////////
    ////    Gestion des pages
    ///////////////////////////////////////////////////////////////////////////////////////////////

    if(isset($_GET['page']) && !empty($_GET['page'])) {
        $page = $_GET['page'];
    } else {
        $page = 1;
    }

    $nbLignesPage = 10;
    $nbLignes     = count($liste_employes_ad);
    
    $mapage = new Pagination($page);
    
    $mapage->setNbPages($nbLignesPage, $nbLignes);
    $mapage->setRecords($nbLignes);
    $mapage->setNbLignesPages($nbLignesPage);

    require ('./admin/admin_views/viewAdmin_liste_employes_ad.php');
}
