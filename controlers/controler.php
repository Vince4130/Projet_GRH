<?php

session_start();

require ('./models/model.php');
include ('./includes/inc_functions.php');

$jour = date('Y-m-d');

function userConnection()
{

    if (isset($_POST['submit'])) {
        if (isset($_POST['login']) && isset($_POST['passwrd'])) {

            $login = htmlspecialchars(trim($_POST['login']));
            $passwrd = htmlspecialchars(trim($_POST['passwrd']));

            $req_autent = connectUser($login, $passwrd);

            if ($req_autent) {

                //Vérification si utilisateur enregistré dans table employe
                $user = $req_autent->fetch(PDO::FETCH_ASSOC);

                if (($user['ident'] !== $login) or ($user['mdpass'] !== $passwrd)) {
                    $_SESSION['utilisateur'] = "inconnu";
                    $text_erreur = "Authentification échouée";
                    $erreur = true;
                    $bdd = null;
                    // redirection('echec.php');

                } else {

                    $erreur = false;
                    $text_erreur = "Authentification réussie"; 

                    //Variables de session pour l'utilisateur authentifié
                    $_SESSION['id'] = (int) ($user['empid']);
                    $_SESSION['nom'] = $user['nom'];
                    $_SESSION['prenom'] = $user['prenom'];
                    $_SESSION['email'] = $user['email'];
                    $_SESSION['ident'] = $user['ident'];
                    $_SESSION['horid'] = (int) ($user['horid']);
                    $_SESSION['mdpass'] = $user['mdpass'];
                    $_SESSION['utilisateur'] == "existe";

                    //Récupération du module horaire d'un employe par une jointure entre la table employe et mod_horaire
                    $id = $_SESSION['id'];
                    $req_mod_horaire = getModuleHoraire($id);
                    $horaire = $req_mod_horaire->fetch(PDO::FETCH_ASSOC);

                    $_SESSION['horaire'] = $horaire;

                    //Formatage du module horaire hh:mm récupéré dans une variable de session
                    // $_SESSION['horaire'] = substr($horaire['hormod'], 0, 5);

                    $req_mod_horaire->closeCursor();
                }
            }
            $req_autent->closeCursor();
        }
    }

    require ('./views/view_connect.php');
}

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
                        
                    $exist = false;
                    $erreur = false; 

                    // /////////////////////////////
                    // //Récupération des données
                    // ////////////////////////////

                    // $nom = htmlspecialchars(trim($_POST['nom']));
                    // $prenom = htmlspecialchars(trim($_POST['prenom']));
                    // $mail = filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL);
                    // $ident = htmlspecialchars(trim($_POST['ident']));
                    // $passwd = $_POST['passwd'];
                    // $horaire = (int) ($_POST['horaire']);
                    //     var_dump($horaire); die;
                    if (!empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['mail']) && !empty($_POST['ident']) && !empty($_POST['passwd']) && !empty($_POST['horaire'])) {


                        /////////////////////////////
                        //Récupération des données
                        ////////////////////////////

                        $nom      = htmlspecialchars(trim($_POST['nom']));
                        $prenom   = htmlspecialchars(trim($_POST['prenom']));
                        $mail     = filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL);
                        $ident    = htmlspecialchars(trim($_POST['ident']));
                        $passwd   = $_POST['passwd'];
                        $horaire  = (int) ($_POST['horaire']);
                        $service  = (int)($_POST['service']);
                        $fonction = (int)($_POST['fonction']);
                        // var_dump($horaire); die;

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
                                $mail = "";
                            } 
                            
                            elseif ($tabresult['ident'] == $ident) {
                                $text_erreur = "Cet identifiant est déjà utilisé";
                                $ident = "";
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
                                $erreur = true;
                                $text_erreur = "Votre enregistrement a échoué";
                            } else {
                                $erreur = false;
                                $text_erreur = "Vous êtes enregistré(e) sur le site Vous pouvez vous connecter";
                                $bdd = null;
                            }

                            $req_registration->closeCursor();
                        }

                    } else {
                        $erreur = true;
                        $text_erreur = "Veuillez remplir tous les champs";
                    }
                } //echo "Existe : ";var_dump($exist); echo " ------ Erreur : "; var_dump($erreur); echo " ------- "; echo $text_erreur; die;
            break;
        }
    }

require('./views/view_registration.php');

}

function accueil()
{
    require('./views/view_accueil.php');

}


function logout()
{

    require ('./includes/header_2.php');
    require ('./views/view_logout.php');
    require ('./includes/footer.php');
}


function saisieDemandeAbsence()
{ 
    if(isset($_POST['submit'])) {

        if (isset($_POST['type_abs']) && isset($_POST['date_deb']) && isset($_POST['date_fin'])) {

            $motif = $_POST['type_abs'];
            $debut = $_POST['date_deb'];
            $fin   = $_POST['date_fin'];
        }
    }
    require('./views/view_abs.php');
}


function welcome()
{

    $id = $_SESSION['id'];

    ///////////////////////////////////////////////////////////////////////////////////////////////
    ///// Calcul du cumul des soldes horaires
    ///////////////////////////////////////////////////////////////////////////////////////////////

    $req_credit = getCredit($id);

    $rows = $req_credit->rowCount();

    $tabResult = $req_credit->fetchAll(PDO::FETCH_ASSOC);

    //Initialisation du cumul
    $cumul = 0;

    for ($i = 0; $i < $rows; $i++) {

        $h_arrivee = $tabResult[$i]['Heure Arrivée'];
        $h_depart = $tabResult[$i]['Heure Départ'];
        $pause = $tabResult[$i]['Pause méridienne'];
        $mod_horaire = $tabResult[$i]['Module horaire'];
        $temps_realise = $tabResult[$i]['Temps réalisé'];
        $point_id = $tabResult[$i]['point_id'];

        $solde = calculerCredit(timeTosecond($h_arrivee), timeTosecond($h_depart), timeTosecond($pause), timeTosecond($mod_horaire));

        if ($solde[0] == "-") {
            $soldeAbs = substr($solde, 1);
            $cumul -= timeTosecond($soldeAbs);
        } else {
            $cumul += timeTosecond($solde);
        }
    }

    $format_cumul = gmdate('H:i', $cumul);

    $req_credit->closeCursor();

    require('./views/view_welcome.php');

}

function userProfil()
{

    $id = $_SESSION['id'];

    /////////////////////////////////
    //Mise à jour du profil
    ////////////////////////////////
    if (isset($_POST['submit'])) {

        //Récupération des valeurs des variables issues du formulaire
        //sinon valeurs des variables de sessions lors de la connexion
        //dans controler_connect.php
        if (isset($_POST['mail']) && $_POST['mail'] != $_SESSION['email']) {
            $mail = filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL);
        } else {
            $mail = $_SESSION['email'];
        }

        if (isset($_POST['passwrd']) && $_POST['passwrd'] != $_SESSION['mdpass']) {
            $pass = htmlspecialchars(trim($_POST['passwrd']));
        } else {
            $pass = $_SESSION['mdpass'];
        }

        // if (isset($_POST['horaire']) && $_POST['horaire'] != $_SESSION['horid']) {
        //     $horaire = horaireId($_POST['horaire']);
        // } else {
        //     $horaire = $_SESSION['horid'];
        // }

        //Requête de mise à jour du profil
        $update_profil = updateProfil($mail, $pass, $id); //$horaire, 

        if ($update_profil !== 1) {
            $echec = true;
            $text = "Pas de mise à jour";
        } else {
            $echec = false;
            $text = "Mise à jour de vos informations";
        }

        $bdd = null;
    }

    //////////////////////////////////////////////
    //Récupération du profil et du module horaire
    /////////////////////////////////////////////
    $req_profil = getProfil($id);

    $employe = $req_profil->fetch(PDO::FETCH_ASSOC);

    $horid = $employe['horid'];

    $mod_horaire = getModuleHoraire($id, $horid);

    $user_schedule = $mod_horaire->fetch(PDO::FETCH_ASSOC);

    $horaire_empl = $user_schedule['Mod_Hor'];



    require('./views/view_profil.php');

}


function historiquePointage()
{

    $id = $_SESSION['id'];

    $req_histo_point = histoPointage($id);

    $nbLignes = $req_histo_point->rowCount();

    $nbLignesPage = 10;

    $nbPages = ceil($nbLignes / $nbLignesPage);

    $tabResult = $req_histo_point->fetchAll(PDO::FETCH_ASSOC);

    ///////////////////////////////////////////////////////////////////////////////////////////////
    ///// Construction du tableau pour affichage de l'historique avec cumul des soldes horaires
    ///////////////////////////////////////////////////////////////////////////////////////////////

    $cumul = 0;

    for ($i = 0; $i < $nbLignes; $i++) {

        $date = $tabResult[$i]['Date']; 
        $h_arrivee = $tabResult[$i]['Heure Arrivée'];
        $h_depart = $tabResult[$i]['Heure Départ'];
        $pause = $tabResult[$i]['Pause méridienne'];
        $mod_horaire = $tabResult[$i]['Module horaire'];
        $temps_realise = $tabResult[$i]['Temps réalisé'];
        $point_id = $tabResult[$i]['point_id'];
        
        // $req_demande_modif = existModifPointage($point_id);
        // $exist             = $req_demande_modif->fetch(PDO::FETCH_ASSOC);
        // $etat_demande      = $exist['etat'];

        $solde = calculerCredit(timeTosecond($h_arrivee), timeTosecond($h_depart), timeTosecond($pause), timeTosecond($mod_horaire));

        if ($solde[0] == "-") {
            $soldeAbs = substr($solde, 1);
            $cumul -= timeTosecond($soldeAbs);
        } else {
            $cumul += timeTosecond($solde);
        }

        $format_cumul = gmdate('H:i', $cumul);

        //Vérification si modification de pointage en attente
        $req_exist_modif = existModifPointage((int)($point_id));
       
        $modif = $req_exist_modif->fetch(PDO::FETCH_ASSOC); 
        
        if($modif) {
            
            $etat = $modif['etat'];

            if($etat == 'En attente') {
                $point_id = 'En attente';
            }

            if($etat == 'Acceptée') {
                $point_id = 'Acceptée';
            }

            if($etat == 'Refusée') {
                $point_id = 'Refusée';
            }
        }
        


        $tab[] = array($date, $h_arrivee, $h_depart, $mod_horaire, $temps_realise, $solde, $format_cumul, $point_id);
    }

    if (!empty($tab)) {
        $tab = array_reverse($tab);
    }

    ///////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////

    ///////////////////////////////////////////////////////////////////////////////////////////////
    ////Gestion des pages
    ///////////////////////////////////////////////////////////////////////////////////////////////

    if (isset($_GET['page']) && !empty($_GET['page'])) {
        
        $pageActuelle = intval($_GET['page']);

        // Si la valeur de $pageActuelle (le numéro de la page) est plus grande que $nombreDePages
        if ($pageActuelle > $nbPages) {
            $pageActuelle = $nbPages;
        }
    } 
    else {
        // La page actuelle est la n°1
        $pageActuelle = 1; 
    }

    ///////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////

    ///////////////////////////////////////////////////////////////////////////////////////////////
    ////Gestion des lignes
    ///////////////////////////////////////////////////////////////////////////////////////////////

    $firstLine = ($pageActuelle - 1) * $nbLignesPage;
    $lastLine = ($pageActuelle * $nbLignesPage) - 1;

    if ($lastLine >= $nbLignes) {
        $lastLine = $lastLine - ($lastLine - $nbLignes) - 1;
    }

    require('./views/view_histo_point.php');
}


function pointage() {

    $today = date('Y-m-d');

    //Récupération des variables de session
    $horaire = $_SESSION['horaire'];
    $idemp   = $_SESSION['id'];
    $horid   = $_SESSION['horid'];
    // var_dump($horaire); //die;
    if (isset($_POST['submit'])) {

        $submit = $_POST['submit'];

        switch ($submit) {

            case "Valider":

            ///////////////////////////////////////////////////////////////
            // RECUPERATIONS DES DONNEES DU FORMULAIRE
            ///////////////////////////////////////////////////////////////

            $ha = (isset($_POST['ha'])) ? $_POST['ha'] : '';
            $p1 = (isset($_POST['p1'])) ? $_POST['p1'] : '';
            $p2 = (isset($_POST['p2'])) ? $_POST['p2'] : '';
            $hd = (isset($_POST['hd'])) ? $_POST['hd'] : '';
            $date = (isset($_POST['date'])) ? $_POST['date'] : '';

            //Variables de session format hh:mm
            $_SESSION['ha'] = $ha;
            $_SESSION['hd'] = $hd;
            $_SESSION['p1'] = $p1;
            $_SESSION['p2'] = $p2;

            ///////////////////////////////////////////////////////////////
            // VALIDATION DES DONNEES
            ///////////////////////////////////////////////////////////////

            //Conversion des temps en secondes
            $module_horaire = timeTosecond($horaire['Mod_Hor']);
            $heureA = timeTosecond($ha);
            $heureP1 = timeTosecond($p1);
            $heureP2 = timeTosecond($p2);
            $heureD = timeTosecond($hd);
            // var_dump($module_horaire); die;

            //Vérification des plages de pointages
            $tabPlageHoraire = verifPointage($heureA, $heureP1, $heureP2, $heureD);

            //Champs non vides
            if (empty($ha) || empty($p1) || empty($p2) || empty($hd) || empty($date)) {
                $champs_vides = true;
            } else {
                $champs_vides = false;
            }
            
            //Date pointage <= date du jour
            $date_ok = verifDate($date, $today);

            if ($date_ok == false) {
                $_SESSION['date'] = "";
            } else {
                $_SESSION['date'] = $date;
            }

            //Vérification si le jour est un jour de week-end
            $week_end = verifWeekEnd($date);

            //Vérification si le jour est férié
            $jour_ferie = verifJourFerie($date);


            ///////////////////////////////////////////////////////////////
            // Validation des vérifications
            ///////////////////////////////////////////////////////////////

            $erreur = false;

            if (!$champs_vides) {

                if (!$date_ok) {
                    $erreur = true;
                    $text_erreur = "La date saisie est postérieure à la date du jour";
                    break;
                }
            
                if ($week_end) {
                    $erreur = true;
                    $text_erreur = "Pas de travail le week-end";
                    $_SESSION['date'] = "";
                    break;
                }

                if ($jour_ferie) {
                    $erreur = true;
                    $dateFormat = dateFrench(inverseDate($date));
                    $text_erreur = "Le $dateFormat est un jour férié";
                    $_SESSION['date'] = "";
                    break;
                }

                //Si tous les champs sont corrects vérification du respect plages horaires variables
                if (($tabPlageHoraire[0] == true) && ($tabPlageHoraire[1] == true) && ($tabPlageHoraire[2] == true)
                    && ($tabPlageHoraire[3] == true) && ($tabPlageHoraire[4] == true)) {

                    //Calcul de la pause méridienne en secondes
                    $ma_pause = pauseM($heureP1, $heureP2);
                    $_SESSION['ma_pause'] = $ma_pause;

                    //Pause format hh:mm
                    $pause_heure = gmdate('H:i', $ma_pause);
                    $_SESSION['pause'] = $pause_heure;
                    
                    //Variables de session en secondes
                    $_SESSION['heureA'] = $heureA;
                    $_SESSION['heureD'] = $heureD;

                    // echo $heureA."   ".$heureD."   ".$ma_pause."    ".$module_horaire; die;

                    //Calcul du crédit en secondes
                    $monCredit = calculerCredit($heureA, $heureD, $ma_pause, $module_horaire);
                    $_SESSION['credit'] = $monCredit;
                    // var_dump($_SESSION['credit']); die;
                } else {
                    $erreur = true;
                    if ($tabPlageHoraire[0] == false) {
                        $text_erreur = "Pointage entre 07:30 et 09:30 le matin";
                        $_SESSION['ha'] = "";
                    }
                    if ($tabPlageHoraire[1] == false) {
                        $text_erreur = "Pointage 1ère pause méridienne entre 11:30 et 13:15";
                        $_SESSION['p1'] = "";
                    }
                    if ($tabPlageHoraire[2] == false) {
                        $text_erreur = "Pointage 2ème pause méridienne avant 14:00";
                        $_SESSION['p2'] = "";
                    }
                    if ($tabPlageHoraire[3] == false) {
                        $text_erreur = "Pointage 2ème pause méridienne antérieure 1ère";
                        $_SESSION['p2'] = "";
                    }
                    if ($tabPlageHoraire[4] == false) {
                        $text_erreur = "Pointage entre 16:00 min et 19:00 le soir";
                        $_SESSION['hd'] = "";
                    }
                }
            } else {
                $erreur = true;
                $color = "red";
                $text_erreur = "Veuillez saisir tous les champs";
            }

            if (!$erreur) {
                redirection('index.php?action=resultats');
            }

            break;

            case "Effacer":
                $_SESSION['date'] = "";
                $_SESSION['ha'] = "";
                $_SESSION['hd'] = "";
                $_SESSION['p1'] = "";
                $_SESSION['p2'] = "";
            break;
        } //Fin du switch
    } //Fin du if

    require('./views/view_pointage.php');
}


function resultPointage() 
{
    
    $id = $_SESSION['id'];

    $creditHeure = $_SESSION['credit'];

    //Mise en forme du temps réalisé dans la journée
    switch ($creditHeure[0]) {
    case "E":
        $_SESSION['creditRes'] = $_SESSION['credit'];
        break;
    case "-":
        $creditHeure = substr($creditHeure, 1);
        $_SESSION['creditRes'] = "-".gmdate('H:i', timeTosecond($creditHeure));
        break;
    default :
        $_SESSION['creditRes'] = gmdate('H:i', timeTosecond($creditHeure));
    break;
    } 

    if (isset($_POST['submit'])) { 

        $action = $_POST['submit'];

        switch ($action) {

            case "Valider":

                $jour = $_SESSION['date'];
            
                $req_deja_pointe = existPointage($jour, $id);

                if ($req_deja_pointe != 1 ) {

                    $ha = $_SESSION['ha'];
                    $hd = $_SESSION['hd'];
                    $p1 = $_SESSION['p1'];
                    $p2 = $_SESSION['p2'];

                    $req_insert_pointage = insertPointage($jour, $ha, $p1, $p2, $hd, $id);
                                   
                    if ($req_insert_pointage != 1) {
                        $text_erreur = "Votre pointage n'est pas enregistré";
                        $erreur = true;
                        // redirection("register.php");
                    } else {
                        $text_erreur = "Votre pointage est enregistré";
                        $erreur = false;
                    }
                        
                }
                else {
                    $text_erreur = "Pointage du ".formatDate(inverseDate($jour))." déjà validé";
                    $erreur = true ; 
                }
                break;

            case "Retour":
                redirection('index.php?action=pointage');
                break;
        }
    }

    require('./views/view_resultats.php');
}


function demModifPoint()   //formulaire
{
    
    $point_id = (int)($_GET['point_id']);
    
    $req_pointage = getPointage($point_id);

    $pointage = $req_pointage->fetch(PDO::FETCH_ASSOC);

    if (isset($_POST['submit'])) {

        $action = $_POST['submit'];
        
        switch($action) {

            case "Valider" :
                
                //Récupération des valeurs des variables issues du formulaire
                $ha   = $_POST['ha'];
                $hd   = $_POST['hd'];
                $pm1  = $_POST['pm1'];
                $pm2  = $_POST['pm2'];
                $date = $_POST['date'];
                $id   = (int)($_POST['point_id']);

                //Vérification existence d'une modification sur ce pointage
                $req_exist_modif = existModifPointage($id);
                
                $exist = $req_exist_modif->fetch(PDO::FETCH_ASSOC);
                
                if(!$exist) {

                     //Requête de demande de modification de pointage
                    $modif_pointage = demandeModifPointage($date, $ha, $pm1, $pm2, $hd, $id);
                    // var_dump($modif_pointage); die;
                    if ($modif_pointage != 1) {
                        $text_erreur = "Votre demande de modification de pointage n'est pas enregistrée";
                        $erreur = true;
                        
                    } else {
                        $text_erreur = "Votre demande de modification de pointage est enregistrée";
                        $erreur = false;
                    }
                } 
                // else {
                //     $text_erreur = "Une demande de modification est en attente sur ce pointage";
                //     $erreur = true;
                // }
               
            break;

            case "Retour" :
                redirection('index.php?action=histo_point');
            break;        
          // $bdd = NULL;
        }

    }

    require('./views/view_dem_modif_point.php');
}
