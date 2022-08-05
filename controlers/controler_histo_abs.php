<?php
session_start();

require ('./models/model_histo_abs.php');

function histoAbsences()
{
    $id = $_SESSION['id'];

    $req_all_abs = getAbsUser($id);

    $absences = $req_all_abs->fetchAll(PDO::FETCH_ASSOC);
    
    foreach($absences as $absence ) {
        $jours[] = calculJourOuvres($absence['debut'], $absence['fin']);
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
    $nbLignes     = count($absences);
    
    if($nbLignes == 0) {
        $nbLignes = 1;
    }
    
    $mapage = new Pagination($page);
    
    $mapage->setNbPages($nbLignesPage, $nbLignes);
    $mapage->setRecords($nbLignes);
    $mapage->setNbLignesPages($nbLignesPage);

    require('./views/view_histo_abs.php');
}
