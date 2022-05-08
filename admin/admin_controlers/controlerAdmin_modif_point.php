<?php

require ('./admin/admin_models/modelAdmin_modif_point.php');
include_once('includes/inc_functions.php');

function listeModifPointage() 
{

    $req_list_modif_point = getAllModifPointage();

    $listModifPoint = $req_list_modif_point->fetchAll(PDO::FETCH_ASSOC);

    $nblignes = count($listModifPoint);
    
    require ('./admin/admin_views/view_modif_point.php');
}

function getModifPointage()
{
    $dempointid = (int)($_GET['dempointid']);

    $req_pointage = getPointageDem($dempointid);

    $req_demande = getDemande($dempointid);

    $pointage =  $req_pointage->fetch(PDO::FETCH_ASSOC);
    
    $demande = $req_demande->fetch(PDO::FETCH_ASSOC);
    // echo "<pre>"; var_dump($demande);
    if(isset($_POST['submit'])) {

        $action = $_POST['submit'];
        
        if($action == "Valider") {
            
            $demande = $_POST['demande'];
            $pointage = $_POST['pointage'];
            var_dump($pointage);
        } 
    }

    require ('./admin/admin_views/view_decision_modif_point.php'); 
}


// function validModifPointage()
// {
    
   
    
// }