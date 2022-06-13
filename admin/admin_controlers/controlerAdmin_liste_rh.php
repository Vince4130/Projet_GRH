<?php
session_start();

require ('./admin/admin_models/modelAdmin_liste_rh.php');

function listeRH()
{

    $liste_rh = getListeRH();

    //Construction d'un tableau pour les responsables RH non admin
    //Il existe un seul admin
    foreach($liste_rh as $rh) {     
        if ($rh['estAdmin'] == false) { 
            $notAdmin [] = $rh;
        }
    }
    
    if(isset($_POST['submit'])) {
        
        $adminid   = intval(filter_input(INPUT_POST, 'adminid', FILTER_SANITIZE_NUMBER_INT));
        $nomRH     = filter_input(INPUT_POST, 'nom', FILTER_SANITIZE_SPECIAL_CHARS);
        $prenomRH  = filter_input(INPUT_POST, 'prenom', FILTER_SANITIZE_SPECIAL_CHARS);
        
        if(!empty($adminid)) {
            
            $req_delete_rh = deleteRH($adminid);
            
            if(!$req_delete_rh) {
                $erreur = true;
                $text_erreur = "Le responsable RH $prenomRH $nomRH n'a pas été supprimé";
            } else {
                $erreur = false;
                $text_erreur = "Le responsable RH $prenomRH $nomRH a été supprimé";
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
    $nbLignes     = count($liste_rh);
    
    $mapage = new Pagination($page);
    
    $mapage->setNbPages($nbLignesPage, $nbLignes);
    $mapage->setRecords($nbLignes);
    $mapage->setNbLignesPages($nbLignesPage);

    require ('./admin/admin_views/viewAdmin_liste_rh.php');
}

