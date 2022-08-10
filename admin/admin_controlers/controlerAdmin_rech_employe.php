<?php
@session_start();

require ('./admin/admin_models/modelAdmin_rech_employe.php');
include_once('includes/inc_functions.php');

function rechEmploye() {
    
    if(isset($_POST['submit'])) {
 
        $nom    = filter_input(INPUT_POST, 'nom', FILTER_SANITIZE_SPECIAL_CHARS);
        $prenom = filter_input(INPUT_POST, 'prenom', FILTER_SANITIZE_SPECIAL_CHARS);

        if (!empty($nom) OR !empty($prenom)) {
            
            $nom    = ucfirst(strtolower($nom));
            $prenom = ucfirst(strtolower($prenom));

            $req_search_empl = searchEmploye($nom, $prenom);

            $mon_empl = $req_search_empl->fetchAll(PDO::FETCH_ASSOC);
          
            $rows = $req_search_empl->rowCount();
          
            if($rows == 0) {
                $erreur      = true;
                $text_erreur = "Recherche infructueuse l'employé $prenom $nom est introuvable";
            } else {
                
                $erreur      = false;

                if ($rows == 1) {
                    $text_erreur = "Vous allez être redirigé vers le profil de $prenom $nom";
                    $id_employe = $mon_empl[0]['empid'];
                    $_SESSION['empid'] = $id_employe; 
                }

                if ($rows > 1) {
                    $_SESSION['employes'] = $mon_empl;
                    $text_erreur = "Vous allez être redirigé vers le résultat de votre recherche";                    
                }
                  
            }

        } else {
            $erreur = true;
            $text_erreur = "Veuillez compléter au moins un champs";
        }
    
    
   
    }
    require ('./admin/admin_views/viewAdmin_rech_employe.php'); 
}