<?php

require ('./admin/admin_models/modelAdmin_creer_rh.php');

include_once('./includes/inc_functions.php');

// $exist = false;

function creerRH()
{
    
    if(isset($_POST['submit'])) {

        $submit = $_POST['submit'];

        switch ($submit) {

            case "Effacer" :

                $nom    = "";
                $prenom = "";
                $ident  = "";
                $passwd = "";
                $color  = "black";

                $_POST['nom']     = "";
                $_POST['prenom']  = "";
                $_POST['ident']   = "";
                $_POST['passwd']  = "";

            break;

            case "Valider" :

                if (isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['ident']) && isset($_POST['passwd']) && isset($_POST['admin'])) {
                        
                    $exist  = false;
                    $erreur = false; 

                    if (!empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['ident']) && !empty($_POST['passwd'])) {

                        /////////////////////////////
                        //Récupération des données
                        ////////////////////////////

                        $nom      = filter_input(INPUT_POST, 'nom', FILTER_SANITIZE_SPECIAL_CHARS);
                        $prenom   = filter_input(INPUT_POST, 'prenom', FILTER_SANITIZE_SPECIAL_CHARS);
                        $ident    = filter_input(INPUT_POST, 'ident', FILTER_SANITIZE_SPECIAL_CHARS);
                        $passwd   = $_POST['passwd'];
                        $estAdmin = (int)$_POST['admin'];

                        $nom    = ucwords(strtolower($nom));
                        $prenom = ucwords(strtolower($prenom));
                        
                        $_SESSION['rh_nom'] = $nom;          
                        
                        $exist_ident_RH = existIdentRH($ident)->fetch(PDO::FETCH_ASSOC);
                        
                        if(!$exist_ident_RH) {
                            
                            ///////////////////////////////////////////////////////////////
                            //Enregistrement de du responsable RH dans la base de donnée
                            ///////////////////////////////////////////////////////////////
                            
                            $insert_rh = insertRH($nom, $prenom, $ident, $passwd, $estAdmin);
                            
                            $insert = $insert_rh->rowCount();
                            
                            if ($insert != 1) {
                                $erreur       = true;
                                $text_erreur  = "Une erreur s'est produite lors de l'enregistrement du resopnsable RH";
                            } else {
                                $erreur       = false;
                                $text_erreur  = "Le responsable RH a été enregistré";
                            }
                        } else {
                            $erreur      = true;
                            $text_erreur = "L'identifiant $ident est déjà utilisé";
                            $_POST['ident'] = "";
                        }
                                
                    } else {
                        $erreur      = true;
                        $text_erreur = "Veuillez compléter tous les champs";
                    }
                } 
                
            break;
        }
    }

require('./admin/admin_views/viewAdmin_creer_rh.php');

}