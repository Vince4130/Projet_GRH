<?php

require('./models/model_registration.php');

include_once('./includes/inc_functions.php');

// $exist = false;

function userInscription()
{
    
    $fonctions = getListFonctions();

    if(isset($_POST['submit'])) {

        $submit = $_POST['submit'];

        switch ($submit) {

            case "Effacer":
                $nom = "";
                $prenom = "";
                $mail = "";
                $ident = "";
                $passwd = "";
                $color = "black";
            break;

            case "Valider":

                if (isset($_POST['nom']) && isset($_POST['prenom']) && (isset($_POST['mail']))
                    && isset($_POST['ident']) && isset($_POST['passwd']) && isset($_POST['horaire'])) {
                        
                    $exist  = false;
                    $erreur = false; 

                    if (!empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['mail']) && !empty($_POST['ident']) && !empty($_POST['passwd']) && !empty($_POST['horaire'])) {

                        /////////////////////////////
                        //Récupération des données
                        ////////////////////////////

                        $nom      = filter_input(INPUT_POST, 'nom', FILTER_SANITIZE_SPECIAL_CHARS);
                        $prenom   = filter_input(INPUT_POST, 'prenom', FILTER_SANITIZE_SPECIAL_CHARS);
                        $mail     = filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL);
                        $ident    = filter_input(INPUT_POST, 'ident', FILTER_SANITIZE_SPECIAL_CHARS);
                        $passwd   = $_POST['passwd'];
                        $horaire  = (int)($_POST['horaire']);
                        $service  = (int)($_POST['service']);
                        $fonction = (int)($_POST['fonction']);

                        ///////////////////////////////////////////////////////////////
                        //Vérification existence du mail et/ou idenfiant dans la base
                        //////////////////////////////////////////////////////////////
                        
                        $req_exist = userMailIdent($mail, $ident);
                        //var_dump($req_exist); echo "<hr>";//die;
                        $rows = $req_exist->rowCount();

                        $tabresult = $req_exist->fetch(PDO::FETCH_ASSOC);

                        if ($rows == 1) {
                            
                            $exist = true;

                            if ($tabresult['email'] == $mail) {                    
                                $text_erreur = "Cette adresse email est déjà utilisée";
                                $mail        = "";
                            } 
                            
                            elseif ($tabresult['ident'] == $ident) {
                                $text_erreur = "Cet identifiant est déjà utilisé";
                                $ident       = "";
                            }
                        }

                        $req_exist->closeCursor();

                        ///////////////////////////////////////////////////////////////
                        //Enregistrement de l'employe dans la base de donnée
                        ///////////////////////////////////////////////////////////////

                        if (!$exist) {
                            
                            $jour = date('Y-m-d');

                            $req_registration = userRegistration($nom, $prenom, $mail, $ident, $passwd, $jour, $horaire, $service, $fonction);

                            $row = $req_registration->rowCount();

                            if ($row != 1) {
                                $erreur      = true;
                                $text_erreur = "Votre enregistrement a échoué";
                            } else {
                                $erreur      = false;
                                $text_erreur = "Vous êtes enregistré(e) sur le site Vous pouvez vous connecter";
                                $bdd         = null;
                            }

                            $req_registration->closeCursor();
                        }

                    } else {
                        $erreur      = true;
                        $text_erreur = "Veuillez remplir tous les champs";
                    }
                } //echo "Existe : ";var_dump($exist); echo " ------ Erreur : "; var_dump($erreur); echo " ------- "; echo $text_erreur; die;
            break;
        }
    }

require('./views/view_registration.php');

}