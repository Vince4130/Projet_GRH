<?php
session_start();

require ('./admin/admin_models/modelAdmin_suppr_employe.php');

function supprEmploye()
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
            alert("Voulez-vous supprimer l'employé $nomEmploye $prenomEmploye définitivement ?"); 
            // $req_delete_employe = deleteEmploye($empid);

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
    
    $mapage = new Pagination($page);
    
    $mapage->setNbPages($nbLignesPage, $nbLignes);
    $mapage->setRecords($nbLignes);
    $mapage->setNbLignesPages($nbLignesPage);

    require ('./admin/admin_views/viewAdmin_suppr_employe.php');
}

function lanceModal() {
   echo "<script>$(window).load(function(){
                    $('#supp').modal('show');
                 });
        </script>";
}
