<?php
session_start();

include_once('./includes/inc_functions.php');

function pointage() {

    $today = date('Y-m-d');

    //Récupération des variables de session
    $horaire = $_SESSION['horaire'];
    $idemp   = $_SESSION['id'];
    $horid   = $_SESSION['horid'];
    //var_dump($horaire); //die;
    if (isset($_POST['submit'])) {

        $submit = $_POST['submit'];

        switch ($submit) {

            case "Valider":

            ///////////////////////////////////////////////////////////////
            // RECUPERATIONS DES DONNEES DU FORMULAIRE
            ///////////////////////////////////////////////////////////////

            $ha   = (isset($_POST['ha'])) ? $_POST['ha'] : '';
            $p1   = (isset($_POST['p1'])) ? $_POST['p1'] : '';
            $p2   = (isset($_POST['p2'])) ? $_POST['p2'] : '';
            $hd   = (isset($_POST['hd'])) ? $_POST['hd'] : '';
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
            $heureA         = timeTosecond($ha);
            $heureP1        = timeTosecond($p1);
            $heureP2        = timeTosecond($p2);
            $heureD         = timeTosecond($hd);
            // var_dump($module_horaire); die;

            //Vérification des plages de pointages à l'aide de la fonction verifPointage dans includes/inc_functions
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
                    $erreur      = true;
                    $text_erreur = "La date saisie est postérieure à la date du jour";
                    break;
                }
            
                if ($week_end) {
                    $erreur      = true;
                    $text_erreur = "Pas de travail le week-end";
                    $_SESSION['date'] = "";
                    break;
                }

                if ($jour_ferie) {
                    $erreur      = true;
                    $dateFormat  = dateEnLettre($date);  //dateFrench(inverseDate($date));
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

                    //Calcul du crédit en secondes
                    $monCredit = calculerCredit($heureA, $heureD, $ma_pause, $module_horaire);
                    
                    if($monCredit == "Erreur") {
                        $erreur = true;
                        $departMax = departMax($heureA, $heureD, $ma_pause);
                        $text_erreur = "Temps de travail quotidien doit être < 10h, départ maximum à $departMax";   
                    } else {
                        $_SESSION['credit'] = $monCredit;
                    }
                        
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
                $_POST['date'] = "";
                $_POST['ha']   = "";
                $_POST['p1']   = "";
                $_POST['p2']   = "";
                $_POST['hd']   = "";
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
