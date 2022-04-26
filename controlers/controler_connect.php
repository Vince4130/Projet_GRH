<?php

session_start();

require('../models/model.php');

include_once('../includes/inc_functions.php');

if (isset($_POST['submit'])) {
    if (isset($_POST['login']) && isset($_POST['passwrd'])) {
        
        $login = htmlspecialchars(trim($_POST['login']));
        $passwrd = htmlspecialchars(trim($_POST['passwrd']));
        
        $req_autent = connectUser($login, $passwrd);

        if ($req_autent) {

            //Vérification si utilisateur enregistré dans table employe
            $ligne = $req_autent->fetch(PDO::FETCH_ASSOC);

            if (($ligne['ident'] !== $login) or ($ligne['mdpass'] !== $passwrd)) {
                $_SESSION['utilisateur'] = "inconnu";
                $text_erreur = "Authentification échouée";
                $erreur = true;
                $bdd = null;
                // redirection('echec.php');

            } else {

                $erreur = false;
                $text_erreur = "Authentification réussie";

                //Variables de session pour l'utilisateur authentifié
                $_SESSION['id'] = (int) ($ligne['empid']);
                $_SESSION['nom'] = $ligne['nom'];
                $_SESSION['prenom'] = $ligne['prenom'];
                $_SESSION['email'] = $ligne['email'];
                $_SESSION['ident'] = $ligne['ident'];
                $_SESSION['horid'] = (int) ($ligne['horid']);
                $_SESSION['mdpass'] = $ligne['mdpass'];
                $_SESSION['utilisateur'] == "existe";
                
                //Récupération du module horaire d'un employe par une jointure entre la table employe et mod_horaire
                $id = $_SESSION['id'];
                $req_mod_horaire = getModuleHoraire($id, $horid);
                $ligne = $req_mod_horaire->fetch(PDO::FETCH_ASSOC);

                //Formatage du module horaire hh:mm récupéré dans une variable de session
                $_SESSION['horaire'] = substr($ligne['hormod'], 0, 5);

                $req_mod_horaire->closeCursor();
            }
        }
        $req_autent->closeCursor();
    }
}

require('../views/view_connect.php');

?>