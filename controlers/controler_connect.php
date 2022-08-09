<?php
@session_start();

require ('./models/model_connect.php');
require ('./models/model_histo_point.php');

$jour = date('Y-m-d');

function userConnection()
{

    if (isset($_POST['submit'])) {

        if (isset($_POST['login']) && isset($_POST['passwrd'])) {

            $login   = filter_input(INPUT_POST, 'login', FILTER_SANITIZE_SPECIAL_CHARS);
            $passwrd = filter_input(INPUT_POST, 'passwrd', FILTER_SANITIZE_SPECIAL_CHARS);

            $req_autent = connectUser($login, $passwrd);
           
            // if ($req_autent) {

                $erreur = false;
                //Vérification si utilisateur enregistré dans table employe
                $user = $req_autent->fetch(PDO::FETCH_ASSOC);

                if ($user == false) { //($user['ident'] !== $login) or ($user['mdpass'] !== $passwrd)
                    
                    $_SESSION['userConnecte'] = false;
                    
                    $erreur      = true;
                    $text_erreur = "Authentification échouée";
                    // $bdd         = null;

                } else {

                    $erreur = false;
                    $text_erreur = "Authentification réussie"; 

                    //Variables de session pour l'utilisateur authentifié
                    $_SESSION['id']           = (int) ($user['empid']);
                    $_SESSION['nom']          = $user['nom'];
                    $_SESSION['prenom']       = $user['prenom'];
                    $_SESSION['email']        = $user['email'];
                    $_SESSION['ident']        = $user['ident'];
                    $_SESSION['horid']        = (int) ($user['horid']);
                    $_SESSION['mdpass']       = $user['mdpass'];
                    //Deplacement variable ci-dessous dans controler welcome
                    // $_SESSION['userConnecte'] = true; 
                    // $_SESSION['estAdmin']     = false; commenté le 06/08/22

                    //Récupération du module horaire d'un employe par une jointure entre la table employe et mod_horaire
                    $id              = $_SESSION['id'];
                    $req_mod_horaire = getModuleHoraire($id);
                    $horaire         = $req_mod_horaire->fetch(PDO::FETCH_ASSOC);

                    $_SESSION['horaire'] = $horaire;

                    //Formatage du module horaire hh:mm récupéré dans une variable de session
                    // $_SESSION['horaire'] = substr($horaire['hormod'], 0, 5);

                    $req_mod_horaire->closeCursor();
                }
            //}
            // var_dump($text_erreur); var_dump($erreur); die;
            $req_autent->closeCursor();
        }
    }

    require ('./views/view_connect.php');
}