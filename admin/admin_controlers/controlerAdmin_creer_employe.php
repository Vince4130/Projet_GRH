<?php

require('./admin/admin_models/modelAdmin_creer_employe.php');

include_once('./includes/inc_functions.php');

// $exist = false;

function creerEmploye()
{
    
    $fonctions     = getListFonctions();
    $services      = getListServices();
    $fonctionsAd   = getFonctionsService(1);
    $fonctionsInfo = getFonctionsService(2);
    $horaires      = getHoraires();
   
    $listeLibServices = servicesLibelle($services);
    
    if(isset($_POST['submit'])) {

        $submit = $_POST['submit'];

        switch ($submit) {

            case "Effacer" :
            
                $_POST['nom']      = "";
                $_POST['prenom']   = "";
                $_POST['mail']     = "";
                $_POST['ident']    = "";
                $_POST['passwd']   = "";
                $_POST['service']  = "";
                $_POST['fonction'] = "";
                $_POST['horaire']  = "";

            break;

            case "Valider" :
                        
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

                    // $libService  = getLibelleService($service);
                    // $libFonction = getLibelleFonction($fonction);
                        
                    $nom    = ucwords(strtolower($nom));
                    $prenom = ucwords(strtolower($prenom));
                        
                    if(filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL)) {
                        $mail = $_POST['mail'];
                    
                        ///////////////////////////////////////////////////////////////
                        //Vérification existence du mail et/ou idenfiant dans la base
                        //Contrainte unique dans la base sur ces champs
                        //////////////////////////////////////////////////////////////

                        // $exist_mail  = existMail($mail)->fetch(PDO::FETCH_ASSOC);
                        // $exist_ident = existIdent($ident)->fetch(PDO::FETCH_ASSOC);

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


                        if(!$exist) {

                            ///////////////////////////////////////////////////////////////
                            //Enregistrement de l'employe dans la base de donnée
                            ///////////////////////////////////////////////////////////////
                            
                            //La date d'embauche correspond à la date du jour
                            $jour = date('Y-m-d');

                            $insert_employe = userRegistration($nom, $prenom, $mail, $ident, $passwd, $jour, $horaire, $service, $fonction);
                            
                            $insert = $insert_employe->rowCount();
                            
                            if ($insert != 1) {
                                $erreur       = true;
                                $text_erreur  = "Une erreur s'est produite lors de l'enregistrement de l'employé";
                            } else {
                                $erreur       = false;
                                $text_erreur  = "L'employé a été enregistré";
                            }
                        }
                            
                    }  else {
                        $erreur      = true;
                        $text_erreur = "Veuillez saisir une adresse mail valide";
                        $mail        = "";
                    }          

                } else {
                    $erreur      = true;
                    $text_erreur = "Veuillez compléter tous les champs";
                }
            break;
        }
    }

require('./admin/admin_views/viewAdmin_creer_employe.php');

}