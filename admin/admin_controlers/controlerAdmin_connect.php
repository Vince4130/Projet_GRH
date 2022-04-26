<?php

session_start();

require ('./admin/admin_models/admin_model.php');
include_once('includes/inc_functions.php');


function adminConnection() {

    if (isset($_POST['submit'])) {
        if (isset($_POST['login']) && isset($_POST['passwrd'])) {
            
            $login = htmlspecialchars(trim($_POST['login']));
            $passwrd = htmlspecialchars(trim($_POST['passwrd']));
            
            $req_autent_admin = connectAdmin($login, $passwrd);

            if ($req_autent_admin) {

                //Vérification si utilisateur enregistré dans table employe
                $admin = $req_autent_admin->fetch(PDO::FETCH_ASSOC);

                if (($admin['ident'] !== $login) or ($admin['mdpass'] !== $passwrd)) {
                    $_SESSION['admin'] = "inconnu";
                    $text_erreur = "Authentification échouée";
                    $erreur = true;
                    $bdd = null;

                } else {

                    $erreur = false;
                    $text_erreur = "Authentification réussie";

                    //Variables de session pour l'utilisateur authentifié
                    $_SESSION['adminid'] = (int) ($admin['adminid']);
                    $_SESSION['nom'] = $admin['nom'];
                    $_SESSION['ident'] = $admin['ident'];
                    $_SESSION['mdpass'] = $admin['mdpass'];
                    $_SESSION['admin'] == "existe";
            
                }
            }
            $req_autent_admin->closeCursor();
        }
    }

require ('./admin/admin_views/view_connect.php');
}


function adminAccueil() 
{

    $listEmployes = getEmployes();
       
    require ('./admin/admin_views/view_accueil.php');
}


function employe()
{   
    $id = (int)($_GET['id']);

    $employe = getEmploye($id);

    $detail_empl = $employe->fetch(PDO::FETCH_ASSOC);

    // var_dump($detail_empl); die;

    require ('./admin/admin_views/view_employe.php');
}