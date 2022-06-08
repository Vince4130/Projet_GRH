<?php
session_start();

require ('./admin/admin_models/modelAdmin_connect.php');

function adminConnection() {
    
    if (isset($_POST['submit'])) {

        if (isset($_POST['login']) && isset($_POST['passwrd'])) {
            
            $login   = filter_input(INPUT_POST, 'login', FILTER_SANITIZE_SPECIAL_CHARS);
            $passwrd = filter_input(INPUT_POST, 'passwrd', FILTER_SANITIZE_SPECIAL_CHARS);
           
            $req_autent_admin = connectAdmin($login, $passwrd);
           
            if ($req_autent_admin) {

                //Vérification si administrateur enregistré dans table admin
                $admin = $req_autent_admin->fetch(PDO::FETCH_ASSOC);
                
                if (($admin['ident'] != $login) or ($admin['mdpass'] != $passwrd)) {
                    
                    $_SESSION['adminConnecte'] = false;

                    $erreur      = true;
                    $text_erreur = "Authentification échouée";
                    $bdd         = null;

                } else {

                    $erreur = false;
                    $text_erreur = "Authentification réussie";

                    //Variables de session pour l'administrateur authentifié
                    $_SESSION['adminid']       = (int)($admin['adminid']);
                    $_SESSION['nom']           = $admin['nom'];
                    $_SESSION['adminIdent']    = $admin['ident'];
                    $_SESSION['mdpass']        = $admin['mdpass'];
                    //Déplacement variable de session dan fonction adminAccueil
                    // $_SESSION['adminConnecte'] = true;
                    $_SESSION['estAdmin']      = true;
            
                }
            } 
            $req_autent_admin->closeCursor();
        }
    }
    
    require ('./admin/admin_views/viewAdmin_connect.php');
}


function adminAccueil() 
{

    $_SESSION['adminConnecte'] = true;
    $listEmployes = getEmployes();
    // echo "<pre>"; var_dump($listEmployes); die;
       
    require ('./admin/admin_views/viewAdmin_accueil.php');
}


// function employe()
// {   
//     $id = (int)($_GET['id']);

//     $employe = getEmploye($id);

//     $detail_empl = $employe->fetch(PDO::FETCH_ASSOC);

//     // echo "<pre>"; var_dump($detail_empl); die;

//     require ('./admin/admin_views/viewAdmin_employe.php');
// }