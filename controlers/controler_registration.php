<?php
@session_start();

require('./models/model_registration.php');
// require('./admin/admin_models/modelAdmin_creer_employe.php');

include_once('./includes/inc_functions.php');

// $exist = false;

function userInscription()
{
    
    $fonctions     = getListFonctions();
    $services      = getListServices();
    $fonctionsAd   = getFonctionsService(1);
    $fonctionsInfo = getFonctionsService(2);
    $horaires      = getHoraires();

    if(isset($_POST['submit'])) {

        $submit = $_POST['submit'];

        switch ($submit) {

            case "Effacer":

                $_POST['nom']      = "";
                $_POST['prenom']   = "";
                $_POST['mail']     = "";
                $_POST['ident']    = "";
                $_POST['passwd']   = "";
                $_POST['service']  = "";
                $_POST['fonction'] = "";
                $_POST['horaire']  = ""; //ajout 08/08/22
                
            break;

            case "Valider":

                // if (isset($_POST['nom']) && isset($_POST['prenom']) && (isset($_POST['mail']))
                //     && isset($_POST['ident']) && isset($_POST['passwd']) && isset($_POST['horaire'])) {
                        
                $exist  = false;
                $erreur = false; 

                if (!empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['mail']) 
                    && !empty($_POST['ident']) && !empty($_POST['passwd']) && !empty($_POST['horaire'])
                    && !empty($_POST['fonction']) && !empty($_POST['service'])) {

                    /////////////////////////////
                    //Récupération des données
                    ////////////////////////////
                        
                    $nom      = filter_input(INPUT_POST, 'nom', FILTER_SANITIZE_SPECIAL_CHARS);
                    $prenom   = filter_input(INPUT_POST, 'prenom', FILTER_SANITIZE_SPECIAL_CHARS);
                    $ident    = filter_input(INPUT_POST, 'ident', FILTER_SANITIZE_SPECIAL_CHARS);
                    $passwd   = $_POST['passwd'];
                    $horaire  = (int)($_POST['horaire']);
                    $service  = (int)($_POST['service']);
                    $fonction = (int)($_POST['fonction']);
                    $credit_ant = filter_input(INPUT_POST, 'credit_ant');
                    
                    $nom    = ucwords(strtolower($nom));
                    $prenom = ucwords(strtolower($prenom));

                    if(filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL)) {
                        $mail = $_POST['mail'];
                    
                    ///////////////////////////////////////////////////////////////
                    //Vérification existence du mail et/ou idenfiant dans la base
                    //////////////////////////////////////////////////////////////
                    
                    $req_exist = userMailIdent($mail, $ident);
                        
                    $rows = $req_exist->rowCount();
                        
                    $tabresult = $req_exist->fetch(PDO::FETCH_ASSOC);
                        
                    if ($rows == 1) {                           
                        
                        $exist = true;

                        if ($tabresult['email'] === $mail) {                    
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
                            $last_id = getLastId();
                            $insert_credit = insertCreditAnterieur($last_id['last_id'], date('H:i', strtotime($credit_ant)));
                            $erreur      = false;
                            $text_erreur = "Vous êtes enregistré(e) sur le site Vous pouvez vous connecter";
                            $bdd         = null;
                        }

                        $req_registration->closeCursor();
                    }
                }
                    else {
                        $erreur = true;
                        $text_erreur = "Veuillez saisir une adresse mail valide";
                        $mail = "";
                    }

                } else {
                    $erreur      = true;
                    $text_erreur = "Veuillez compléter tous les champs";
                }
            //}
            $_SESSION['exist']       = $exist;
            $_SESSION['erreur']      = $erreur;
            $_SESSION['text_erreur'] = $text_erreur;
            // echo "Existe : ";var_dump($exist); echo " ------ Erreur : "; var_dump($erreur); echo " ------- "; echo $text_erreur; die;
        break;
        }
    }

require('./views/view_registration.php');

}