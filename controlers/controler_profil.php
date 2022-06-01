<?php
session_start();

require('./models/model_profil.php');
include_once('./includes/inc_functions.php');

function userProfil()
{

    $id = $_SESSION['id'];
    $erreur = false;
    
    /////////////////////////////////
    //Mise à jour du profil
    ////////////////////////////////
    if (isset($_POST['submit'])) {

        //Récupération des valeurs des variables issues du formulaire sinon valeurs des variables de session lors de la connexion
        if (isset($_POST['mail']) && $_POST['mail'] != $_SESSION['email']) {
            
            $mail = filter_input(INPUT_POST, 'mail', FILTER_SANITIZE_EMAIL);
            
            //Vérification de l'existence du mail dans la base
            if($exist = existMail($mail)) {
                $erreur      = true;                  
                $text_erreur = "Cette adresse email est déjà utilisée";
            }

        } else {

            $mail = $_SESSION['email'];
        }

        if (isset($_POST['ident']) && $_POST['ident'] != $_SESSION['ident']) {
            
            $ident = filter_input(INPUT_POST, 'ident', FILTER_SANITIZE_SPECIAL_CHARS);
            
            //Vérification de l'existence de l'identifiant dans la base
            if($exist = existIdent($ident)) {
                $erreur      = true;                  
                $text_erreur = "Cet identifiant est déjà utilisé";
            }

        } else {

            $ident = $_SESSION['ident'];
        }

        if (isset($_POST['passwrd']) && $_POST['passwrd'] != $_SESSION['mdpass']) {
            $pass = filter_input(INPUT_POST, 'passwrd', FILTER_SANITIZE_SPECIAL_CHARS);
        } else {
            $pass = $_SESSION['mdpass'];
        }

        //Requête de mise à jour du profil si le email et l'identifiant ne sont pas dans la base
        if(!$erreur) {
            $update_profil = updateProfil($mail, $ident, $pass, $id); //$horaire, 

            if ($update_profil !== 1) {
                $erreur = true;
                $text_erreur  = "Pas de mise à jour";
            } else {
                $erreur = false;
                $text_erreur  = "Mise à jour de vos informations";
            }
        }
       
    }


    //////////////////////////////////////////////
    //Récupération du profil et du module horaire
    /////////////////////////////////////////////

    if(!empty($id)) {

        $req_profil = getProfil($id);

        $employe = $req_profil->fetch(PDO::FETCH_ASSOC);

        $horid    = $employe['horid'];
        $servid   = $employe['servid'];
        $fonctid  = $employe['fonctid'];
        $embauche = $employe['dateEmbauche']; 

        $mod_horaire = getModuleHoraire($id, $horid);
        $service     = getService($servid);
        $fonction    = getFonction($fonctid);
        $anciennete  = getAnciennete($id);
     
        $user_schedule   = $mod_horaire->fetch(PDO::FETCH_ASSOC);
        $user_service    = $service->fetch(PDO::FETCH_ASSOC);
        $user_fonction   = $fonction->fetch(PDO::FETCH_ASSOC);
        $user_anciennete = $anciennete->fetch(PDO::FETCH_ASSOC);
      
        $horaire_empl     = $user_schedule['Mod_Hor'];
        $service_empl     = $user_service['libelle'];
        $fonction_empl    = $user_fonction['libelle'];
        $anciennete_empl  = $user_anciennete['anciennete'];

        if($anciennete_empl < 12) {
            $mois = $anciennete_empl;
            $anciennete_empl = $mois." mois";
        } 
    
        if($anciennete_empl >= 12) {
            $an   = floor($anciennete_empl/12);
            $mois = $anciennete_empl%12;
            
            if($an == 1) {
                if($mois > 0) {
                    $anciennete_empl = $an." an et ".$mois." mois";
                } else {
                    $anciennete_empl = $an." an";
                }
            } else {
                if($mois > 0) {
                    $anciennete_empl = $an." ans et ".$mois." mois";
                } else {
                    $anciennete_empl = $an." ans";
                }
            }
        }
        
        require('./views/view_profil.php');

    } else {
        header('Location: index.php?action=accueil');
        exit();
    }
}