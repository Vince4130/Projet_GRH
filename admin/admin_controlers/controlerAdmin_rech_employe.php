<?php
@session_start();

require ('./admin/admin_models/modelAdmin_rech_employe.php');
include_once('includes/inc_functions.php');

function rechEmploye() {
    
    if(isset($_POST['submit'])) {
 
        $nom    = filter_input(INPUT_POST, 'nom', FILTER_SANITIZE_SPECIAL_CHARS);
        $prenom = filter_input(INPUT_POST, 'prenom', FILTER_SANITIZE_SPECIAL_CHARS);

        if (!empty($nom) && !empty($prenom)) {
            
            $nom    = ucfirst(strtolower($nom));
            $prenom = ucfirst(strtolower($prenom));

            $req_search_empl = searchEmploye($nom, $prenom);

            $mon_empl = $req_search_empl->fetch(PDO::FETCH_ASSOC);

            if(!$mon_empl) {
                $erreur      = true;
                $text_erreur = "Recherche infructueuse l'employé $prenom $nom est introuvable";
            } else {
                $erreur      = false;
                $text_erreur = "Vous allez être redirigé vers le profil de $prenom $nom";
                $id_employe = $mon_empl['empid'];
                $_SESSION['empid'] = $id_employe;    
            }
        } else {
            $erreur = true;
            $text_erreur = "Veuillez compléter tous les champs";
        }
    }
    
    require ('./admin/admin_views/viewAdmin_rech_employe.php'); 
}