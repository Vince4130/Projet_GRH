<?php
session_start();

require ('./admin/admin_models/modelAdmin_liste_employes.php');

function listeEmployes()
{

    $liste_employes = getListeEmployes();

    if(isset($_POST['submit'])) {
        
        $empid          = intval(filter_input(INPUT_POST, 'empid', FILTER_SANITIZE_NUMBER_INT));
        $nomEmploye     = filter_input(INPUT_POST, 'nom', FILTER_SANITIZE_SPECIAL_CHARS);
        $prenomEmploye = filter_input(INPUT_POST, 'prenom', FILTER_SANITIZE_SPECIAL_CHARS);

        $_SESSION['empid']         = $empid;
        $_SESSION['nomEmploye']    = $nomEmploye;
        $_SESSION['prenomEmploye'] = $prenomEmploye;
 
        if(!empty($empid)) {
            // alert("Voulez-vous supprimer l'employé $nomEmploye $prenomEmploye définitivement ?"); 
            $req_delete_employe = deleteEmploye($empid);
    
                
            if(!$req_delete_employe) {
                $erreur = true;
                $text_erreur = "L'employé $prenomEmploye $nomEmploye n'a pas été supprimé";
            } else {
                $erreur = false;
                $text_erreur = "L'employé $prenomEmploye $nomEmploye a été supprimé";
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
    $nbLignes     = count($liste_employes);
    
    if($nbLignes == 0) {
        $nbLignes = 1;
    }
    
    $mapage = new Pagination($page);
    
    $mapage->setNbPages($nbLignesPage, $nbLignes);
    $mapage->setRecords($nbLignes);
    $mapage->setNbLignesPages($nbLignesPage);

    require ('./admin/admin_views/viewAdmin_liste_employes.php');
}