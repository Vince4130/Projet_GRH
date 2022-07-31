<?php
session_start();

require('./models/model_reinit_pwd.php');

function reinitPwd()
{

    $id = $_SESSION['id']; 

    if (isset($_POST['submit'])) {

        if(!empty($_POST['mdp1']) && !empty($_POST['mdp2'])) {

            $mdp1 = $_POST['mdp1'];
            $mdp2 = $_POST['mdp2'];

            if ($mdp1 !== $mdp2) {

                $erreur      = true;
                $text_erreur = "Erreur de saisie : mots de passe différents";
                
            } else {
                $erreur = false;
                
                $update = updatePwd($id, $mdp1);

                if ($update !== 1) {
                    $erreur       = true;
                    $text_erreur  = "Votre mot de passe n'a pas été mis à jour";
                } else {
                    $echec        = false;
                    $text_erreur  = "Mise à jour de votre mot de passe";
                }
                
            }
        }
    }

    require('./views/view_reinit_pwd.php');

}