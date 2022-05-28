<?php
session_start();

require ('./models/model_consult_dem_abs.php');

function consultDemAbs()
{
    $id = $_SESSION['id'];

    $req_dem_abs = getDemAbsUser($id);

    $dem_abs = $req_dem_abs->fetchAll(PDO::FETCH_ASSOC);

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

    // ///////////////////////////////////////////////////////////////////////////////////////////////
    // ////    Gestion des pages
    // ///////////////////////////////////////////////////////////////////////////////////////////////
    // $nbLignesPage = 10;
    // $nbPages      = ceil($nbLignes / $nbLignesPage);

    // if (isset($_GET['page']) && !empty($_GET['page'])) {
        
    //     $pageActuelle = intval($_GET['page']);

    //     // Si la valeur de $pageActuelle (le numéro de la page) est plus grande que $nombreDePages
    //     if ($pageActuelle > $nbPages) {
    //         $pageActuelle = $nbPages;
    //     }
    // } 
    // else {
    //     // La page actuelle est la n°1
    //     $pageActuelle = 1; 
    // }

    // ///////////////////////////////////////////////////////////////////////////////////////////////
    // ///////////////////////////////////////////////////////////////////////////////////////////////

    // ///////////////////////////////////////////////////////////////////////////////////////////////
    // ////    Gestion des lignes
    // ///////////////////////////////////////////////////////////////////////////////////////////////

    // $firstLine = ($pageActuelle - 1) * $nbLignesPage;
    // $lastLine = ($pageActuelle * $nbLignesPage) - 1;

    // if ($lastLine >= $nbLignes) {
    //     $lastLine = $lastLine - ($lastLine - $nbLignes) - 1;
    // }

    require('./views/view_consult_dem_abs.php');
}
