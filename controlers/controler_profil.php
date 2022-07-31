<?php
session_start();

require('./models/model_profil.php');
include_once('./includes/inc_functions.php');

function userProfil()
{

    $id = $_SESSION['id'];
    // $erreur = false;
    
    /////////////////////////////////
    //Mise à jour du profil
    ////////////////////////////////
    if (isset($_POST['submit'])) {

        $profil = getProfil($id);
        $mon_profil = $profil->fetch(PDO::FETCH_ASSOC);
        $mon_mail   = $mon_profil['email'];
        $mon_ident  = $mon_profil['ident'];
        $mon_pwd    = $mon_profil['mdpass'];
        // echo "<pre>"; var_dump($mon_profil);

        $mail  = filter_input(INPUT_POST, 'mail', FILTER_SANITIZE_EMAIL);
        $ident = filter_input(INPUT_POST, 'ident', FILTER_SANITIZE_SPECIAL_CHARS);
        $pass  = filter_input(INPUT_POST, 'passwrd', FILTER_SANITIZE_SPECIAL_CHARS);

        //Vérification si variables postées toutes différentes du profil de l'employé
        if($mail == $mon_mail && $ident == $mon_ident && $pass == $mon_pwd) {
            $erreur = true;
            $text_erreur = "Aucune modification";
        } else {

            $exist_mail  = existMail($mail)->fetch(PDO::FETCH_ASSOC);
            $exist_ident = existIdent($ident)->fetch(PDO::FETCH_ASSOC);

            //Cas ou mail et idenfiant postés différents du profil
            if ($mail != $mon_mail && $ident != $mon_ident) {
                
                //Vérification de l'existence en base du mail et de l'identifiant
                //Contrainte d'unicité de l'email et de l'identifiant en base
                if(!$exist_mail) {

                    if(!$exist_ident) {

                        $update_profil = updateProfil($mail, $ident, $pass, $id); 

                        if ($update_profil !== 1) {
                            $erreur = true;
                            $text_erreur  = "Une erreur s'est produite lors de la mise à jour";
                        } else {
                            $erreur = false;
                            $text_erreur  = "Votre profil a été mis à jour";
                        }
                    } else {
                        $erreur = true;
                        $text_erreur = "Cette identifiant est déjà utilisé";
                    }
                    
                } else {
                    $erreur = true;
                    $text_erreur = "Cette adresse mail est déjà utilisée";
                }            
            } else {
                
                //Mail différent et identifiant égal
                if($mail != $mon_mail && $ident == $mon_ident) {
                    
                    if (!$exist_mail) {
                        
                        $update_mail = updateMail($mail, $pass, $id);
                        
                        if ($update_mail !== 1) {
                            $erreur = true;
                            $text_erreur  = "Une erreur s'est produite lors de la mise à jour";
                        } else {
                            $erreur = false;
                            $text_erreur  = "Votre profil a été mis à jour";
                        }
                       
                    } else {
                        $erreur      = true;
                        $text_erreur = "Cette adresse mail est déjà utilisée";
                    }
                }

                //Mail égal et identifiant différent
                if($mail == $mon_mail && $ident != $mon_ident) {
                    
                    if (!$exist_ident) {
                        $update_ident = updateIdent($ident, $pass, $id);
                        
                        if ($update_ident !== 1) {
                            $erreur = true;
                            $text_erreur  = "Une erreur s'est produite lors de la mise à jour";
                        } else {
                            $erreur = false;
                            $text_erreur  = "Votre profil a été mis à jour";
                        }
                        
                    } else {
                        $erreur      = true;
                        $text_erreur = "Cet identifiant est déjà utilisé";
                    }
                }
            }
        }
        //Mail et identifiant semblables profil de l'employé mais changement de mot de passe
        if ($mail == $mon_mail && $ident == $mon_ident && $pass != $mon_pwd) {

            $update_pwd = updatePassword($pass, $id); 

            if ($update_pwd !== 1) {
                $erreur = true;
                $text_erreur  = "Une erreur s'est produite lors de la mise à jour";
            } else {
                $erreur = false;
                $text_erreur  = "Votre profil a été mis à jour";
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

        //Mise en forme de l'ancienneté pour affichage
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

    }    else {
            header('Location: index.php?action=accueil');
            exit();
    }
}