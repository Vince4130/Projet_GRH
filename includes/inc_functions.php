<?php

include('inc_constantes.php');



// ///Connexion à la base de données////
// /**
//  * connexDB
//  *
//  * @param  mixed $base
//  * @return void
//  */
// function connexDB($base)
// {

//     include_once ('inc_param.php');

//     $dsn = "mysql:host=" . HOST . ":" . PORT . ";dbname=" . $base.";charset=UTF8";

//     $user = USER;
//     $pass = PWD;

//     try {
//         $bdd = new PDO($dsn, $user, $pass, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
//         return $bdd;
//     } catch (PDOException $e) {
//         echo "Echec connexion : ", $e->getMessage();
//         return false;
//         exit();
//     }
// }



/**
 * Vérification que date en parametre n'est pas postérieure date du jour
 * verifDate
 *
 * @param  date $date
 * @return boolean
 */
function verifDate($date, $today)
{
    $dateOk = true;
    // $today = strtotime(date('Y-m-d'));
    // $madate = strtotime($date);
    if ($date > $today) {
        $dateOk = false;
    }

    return $dateOk;
}


/**
 * Inversion de la date : Y-m-d => d-m-Y
 * inverseDate
 *
 * @param  date $date séparateur -
 * @return date $date_inverse séparateur /
 */
function inverseDate($date)
{   

    $tab = list($annee, $mois, $jour) = explode("-", $date);

    $date_inverse = $jour . "-" . $mois . "-" . $annee;

    return $date_inverse;
}


/**
 * Format de la date : d-m-Y => d/m/Y
 * utilisé pour certains affichages
 * @param mixed $date
 * 
 * @return [type]
 */
function formatDate($date) {

    $tab = list($jour, $mois, $annee) = explode("-", $date);

    $date_format = $jour . "/" . $mois . "/" . $annee;

    return $date_format;

}


/**
 * Vérification si date en paramètre est un jour de week end
 * verifWeekEnd
 *
 * @param  mixed $date
 * @return boolean $weekend
 */
function verifWeekEnd($date)
{
    $weekend = false;

    $jour = date('l', strtotime($date));

    if (($jour == "Saturday") || ($jour == "Sunday")) {
        $weekend = true;
    }

    return $weekend;
}



/**
 * Verification si date en parametre est un jour ferie
 * verifJourFerie
 *
 * @param  date $date
 * @return boolean $jourFerie
 */
function verifJourFerie($date)
{
    $jourFerie = false;
    
    $year = date('Y');
    
    $easter = date('Y-m-d', easter_date($year));

    $Mondayeaster = date('Y-m-d', strtotime($easter . "+1days")); //1
    $ascencion = date('Y-m-d', strtotime($easter . "+39days")); //39
    $pentecote = date('Y-m-d', strtotime($easter . "+50days")); //50
   
    $tabJourFerie = ["$year-01-01", $Mondayeaster, "$year-05-01", "$year-05-08", $ascencion, $pentecote, "$year-07-14", "$year-08-15", "$year-11-01", "$year-11-11", "$year-12-25"];

    if (in_array($date, $tabJourFerie)) {
        $jourFerie = true;
    }

    return $jourFerie;
}


/**
 * Conversion de la date en français
 * dateFrench
 * 
 * @param  date $date : format dd-mm-yyyy
 * @return date $dateF : date en français jour en chiffre mois en lettres et année
 */
function dateFrench($date)
{
   
    $tabSemaine = array("dimanche", "lundi", "mardi", "mercredi", "jeudi", "vendredi", "samedi");
    $tabMois = array(1 => "janvier", 2 => "février", 3 => "mars", 4 => "avril", 5 => "mai", 6 => "juin", 7 => "juillet", 8 => "aôut", 9 => "septembre", 10 => "octobre", 11 => "novembre", 12 => "décembre");

    $tab = list($jour, $mois, $annee) = explode("-", $date);

    $dateF = $tabSemaine[date('w')] . " " . $jour . " " . $tabMois[(int)($mois)] . " " . $annee;

    return $dateF;
}


/**
 * Retourne la date en francais avec une date au format Y-m-D
 * 
 * @param mixed $date
 * 
 * @return [type]
 */
function dateEnLettre($date)
{
    $tabSemaine = array("dimanche", "lundi", "mardi", "mercredi", "jeudi", "vendredi", "samedi");
    $tabMois    = array(1 => "janvier", 2 => "février", 3 => "mars", 4 => "avril", 5 => "mai", 6 => "juin", 7 => "juillet", 8 => "aôut", 9 => "septembre", 10 => "octobre", 11 => "novembre", 12 => "décembre");
    
    $tab = list($annee, $mois, $jour) = explode("-", $date);

    $num_jour = gregoriantojd($mois, $jour, $annee);

    $jour_en_lettre = $tabSemaine[jddayofweek($num_jour, 0)];

    $date_en_lettre = $jour_en_lettre. " " . $jour . " ". $tabMois[(int)($mois)] . " " . $annee;
    
    return $date_en_lettre;
}

/**
 * Conversion de hh:mm en secondes/
 * timeTosecond
 *
 * @param  string $time : format hh:mm
 * @return int $secondes : temps en secondes
 */
function timeTosecond($time)
{
    $secondes = 0;

    if ($time != "") {

        list($heure, $minute) = explode(":", $time);
        $secondes = ((int) $heure) * 3600 + ((int) $minute) * 60;

    }
    
    return $secondes;
}


/**
 * Permet d'afficher un texte et un décompte en secondes
 * avant redirection vers une autre page
 *
 * @param mixed $text_erreur
 * @param mixed $secondes
 * 
 * @return [type]
 */
function afficheDecompteSecondes ($text_erreur, $secondes) {
    echo "<script>decompte(\"$text_erreur\", \"$secondes\"); </script>";
}


/**
 * Validation des pointages
 * Arrivée entre 07:30 et 09:30 $heureA
 * Départ entre 16:00 et 19:00 $heureD
 * Pause méridienne entre 11:30 et 13:15 et avant 14:00 $heureP1 et $heureP2
 * avec un minimum de 45' décompté
 * vérification 2ème pointage après le 1er
 *
 * @param  mixed $heureA
 * @param  mixed $heureP1
 * @param  mixed $heureP2
 * @param  mixed $heureD
 * @param utilisation constantes horaires
 * @return array de variables booléennes : chaque plage horaire respectée ou non
 */
function verifPointage($heureA, $heureP1, $heureP2, $heureD)
{
    $tabResultat = array();

    //Arrivée entre 07:30 et 09:30
    if (($heureA < MATIN_1) || ($heureA > MATIN_2)) {
        $pointage1 = false;
    } else {
        $pointage1 = true;
    }

    //Pause méridienne entre 11:30 et 13:15
    if (($heureP1 < PAUSE_1) || ($heureP1 > PAUSE_2)) {
        $pointage2 = false;
    } else {
        $pointage2 = true;
    }

    //Retour pause méridienne avant 14h
    if ($heureP2 > PAUSE_RETOUR) {
        $pointage3 = false;
    } else {
        $pointage3 = true;
    }

    //Retour pause méridienne après 1er pointage pause méridienne
    if ($heureP2 < $heureP1) {
        $pointage23 = false;
    } else {
        $pointage23 = true;
    }

    //Départ à partir de 16h jusqu'à 19h maximum
    if (($heureD < SOIR_1) || ($heureD > SOIR_2)) {
        $pointage4 = false;
    } else {
        $pointage4 = true;
    }

    $tabResultat = array($pointage1, $pointage2, $pointage3, $pointage23, $pointage4);

    return $tabResultat;
}



/**
 * Calcul du temps de pause méridienne, si < 45mn pause = 45mn pause maximale 2h30
 *
 * @param  mixed $heureP1 : pointage 1 pause méridienne (entre 11:30 et 13:15)
 * @param  mixed $heureP2 : pointage 2 pause méridienne (14h maximum)
 * @return int $pause : temps de pause en secondes
 */
function pauseM($heureP1, $heureP2)
{
    $pause = 0;

    if ((($heureP1 >= PAUSE_1) && ($heureP1 <= PAUSE_2)) && (($heureP2 > $heureP1) && ($heureP2 <= PAUSE_RETOUR))) {
        
        $pause = $heureP2 - $heureP1;
        
        if ($pause < PAUSE_MIN) {
            $pause = PAUSE_MIN;
        }
        
        if ($pause > PAUSE_MAX) {
            $pause = PAUSE_MAX;
        }
    }

    return $pause;
}


/**
 * Calcul du crédit de la journée
 * calculerCredit
 *
 * @param  mixed $heureA : heure arrivée
 * @param  mixed $heureD : heure départ
 * @param  mixed $maPause : temps pause méridienne
 * @param  mixed $module_horaire : durée journée de travail
 * @param  utilisation constante JOURNEE_MAX
 * @return string $result : crédit/débit de la journée
 */
function calculerCredit($heureA, $heureD, $maPause, $module_horaire)
{

    //Pause méridienne minimale 45'
    if($maPause < PAUSE_MIN) {
        $maPause = PAUSE_MIN;
    }

    //Temps de travail effectif en secondes
    $tempsTravail = $heureD - $heureA - $maPause;
    
    //Crédit ou débit de temps réalisé dans la journée = différence temps de travail effectif et module horaire
    $secondes = $tempsTravail - $module_horaire;
    // echo "Temps de travail : ";var_dump($tempsTravail); echo "Credit en secondes : "; var_dump($secondes); echo "<hr />";
    $credit = false;

    $H_M = gmdate('H:i', abs($secondes));
    // var_dump($H_M); echo "<hr />";
    if ($secondes >= 0) {
        $credit = true;
    } else {
        $credit = false;
    }

    if ($tempsTravail <= JOURNEE_MAX) {
        
        if ($credit == true) {
            $result = $H_M;
        } else {
            $result = "-" . $H_M;
        }
    
    } else {

        // $departMax = $heureA + $maPause + JOURNEE_MAX;
        // $hMax = gmdate('H:i', $departMax);
        // $text_erreur = "Temps de travail quotidien doit être < 10h \\n Départ maximum à $hMax";
        $result = "Erreur";
    }
    // var_dump($result); die;
    return $result;
}

/**
 * Retourne l'heure de départ maximale
 * pour respecter la durée de journée de travail <= 10h
 * Les paramètres de la fonction sont en secondes
 * 
 * @param int $ha heure d'arrivée
 * @param int $hd heure de départ
 * @param int $pause temps de pause calculée
 * 
 * @return string
 */
function departMax($ha, $hd, $pause) {

    $tempsTravail = $hd - $ha - $pause;
    
    if($tempsTravail > JOURNEE_MAX) {

        $departMax = $ha + $pause + JOURNEE_MAX;
        $hMax = gmdate('H:i', $departMax);
       
    }
    return $hMax;
}

/**
 * Calcul heure de départ avec un temps de crédit souhaité
 * calculerDepart
 *
 * @param  mixed $heureA : heure arrivée
 * @param  mixed $pause : temps de pause méridienne
 * @param  mixed $credit : temps de crédit souhaité
 * @param  mixed $module_horaire : temps de travail
 * @return string $result : heure de départ
 */
function calculerDepart($heureA, $pause, $credit, $module_horaire)
{

    $H_M = gmdate('H:i', $credit);

    $departCredit = $heureA + $pause + $module_horaire + $credit;
    $H_Credit = gmdate('H:i', $departCredit);
    //echo "Depart supposé ".$departCredit."<hr />";

    $creditMax = 68400 - $heureA - $module_horaire - $pause;
    $Max = gmdate('H:i', $creditMax);

    $departMax = $heureA + $pause + JOURNEE_MAX;
    $DepMax = gmdate('H:i', $departMax);

    /*
    echo "Credit voulu : ".$credit." soit : ".$H_M." ---- Credit max : ".$creditMax." soit : ".$Max."<hr />";
    echo "Départ crédit : ".$departCredit." soit : ".$H_Credit."<hr />";
    echo "Journée de travail + credit ".($module_horaire + $credit)." secondes et journéé max ".JOURNEE_MAX." secondes<hr />";
    echo "Heure de départ max ".$DepMax."<hr />"; //die;
     */

    if (($module_horaire + $credit) <= JOURNEE_MAX) {
        if ($departCredit <= SOIR_2) {
            $result = $H_Credit;
        } else {
            alert("Départ max 19h\\n Crédit Max : " . $Max);
            $_SESSION['creditheure'] = $Max;
            $result = "19:00";
        }
    } else {
        alert("Temps de travail quotidien doit être < 10h");
        if ($departMax <= SOIR_2) {
            $result = $DepMax;
        } else {
            alert("Départ max à 19h\\n Crédit Max : " . $Max);
            $_SESSION['creditheure'] = $Max;
            $result = "19:00";
        }
    }
    // var_dump($result); die;
    return $result;
}


/**
 * Calcul l'heure de départ sans perdre de crédit
 * creditNul
 *
 * @param  mixed $heureA : heure d'arrivée
 * @param  mixed $pause : temps de pause méridienne
 * @param  mixed $module_horaire : durée de la journée de travail
 * @return string $heureDepart : heure de départ
 */
function creditNul($heureA, $pause, $module_horaire)
{

    $CreditNul = $heureA + $module_horaire + $pause;
    // var_dump($heureA); echo "<hr />"; var_dump($module_horaire); echo "<hr />"; var_dump($pause); echo "<hr />";var_dump($CreditNul); die;
    $perte = (SOIR_2 - $heureA - $pause - $module_horaire); //* -1;
    $gain = SOIR_1 - ($heureA + $pause + $module_horaire);

    ////Si départ entre 16h00 et 19h00////
    if (($CreditNul >= SOIR_1) && ($CreditNul <= SOIR_2)) {
        $heureDepart = gmdate('H:i', $CreditNul);
        // alert('Pour ne pas perdre de crédit, vous devez partir à \n '.$heureDepart);
    } else {

        if ($CreditNul < SOIR_1) {
            $heureDepart = "16:00";
            $hGain = gmdate('H:i', $gain);
            alert('Départ min à 16:00 \n vous gagnez '.$hGain);
        }

        if ($CreditNul > SOIR_2) {
            $heureDepart = "19:00";
            if ($perte < 0) {
                $hPerte = gmdate('H:i', abs($perte));
                alert('Départ max à 19:00 \n vous perdez ' . '-' . $hPerte);
            }
        }
    }
    
    return $heureDepart;
}


/**
 * Affichage pop up
 * alert
 *
 * @param  mixed $msg
 * @return void
 */
function alert($msg)
{
    echo "<script>alert(\"$msg\");</script>";
}


/**
 * Redirection de page si header non utilisable
 * redirection
 *
 * @param  mixed $page ex 'page.php'
 * @return void
 */
function redirection($page)
{
    echo "<script>window.location=\"$page\";</script>";
}


/**
 * Mise à jour du tri : croissant ou décroissant
 * 
 * @param mixed $typeTri
 *
 * @return [type] $lien
 */
function updateLien($tri)
{
    if ($tri == 0) {
        $newType = 1;
        $chevron = "<i class=\"fas fa-angle-up\"></i>";
    } else {
        $newType = 0;
        $chevron = "<i class=\"fas fa-angle-down\"></i>";
    }
    $lien = "<a href=\"historique_pointage.php?tri=$newType\" class=\"tri\"> Date&nbsp;&nbsp;$chevron</a> ";
    
    return $lien;
}


/**
 * Conversion horaire string issu formulaire en int
 * horid clé primaire de la table mod_horaire
 * clé étrangère de la table employe
 * horaireId
 *
 * @param  string $horaire
 * @return int $horid
 */
function horaireId($horaire)
{
    switch ($horaire) {
        case "07:00":
            $horid = 1;
            break;
        case "07:14":
            $horid = 2;
            break;
        case "07:30":
            $horid = 3;
            break;
        case "07:36":
            $horid = 4;
            break;
        case "07:42":
            $horid = 5;
            break;
    }

    return $horid;
}


/**
 * Retourne le nombre de jours ouvrés entre 2 dates
 * =>pas de week end et jours fériés
 * 
 * @param mixed $debut
 * @param mixed $fin
 * 
 * @return [type]
 */
function calculJourOuvres($debut, $fin) {

    $start = new DateTime($debut);
    $end   = new DateTime(date('Y-m-d',strtotime($fin.'+1days')));

    //Création d'un tableau de dates sur la période d'absence
    $interval = new DateInterval('P1D');
    $period   = new DatePeriod($start ,$interval, $end);
     
    foreach($period as $day) {
        $absences [] =  $day->format('Y-m-d');
    }
    
    $nbAbs = count($absences);
    
    //Calcul du nombre de jours ouvrés sur la période
    for($i = 0; $i <= $nbAbs; $i++) {
        if(verifJourFerie($absences[$i]) OR verifWeekEnd($absences[$i])) {
            $jourNonDecompte++;
        }
    }
    
    //Nombre de jours d'absences réél => sans we et/ou jours fériés
    $nbJourAbs = $nbAbs - $jourNonDecompte;
   
    return $nbJourAbs;
}

/**
 * Retourne un tableau de dates
 * sur la période d'absence
 * 
 * @param mixed $debut
 * @param mixed $fin
 * 
 * @return [type]
 */
function intervalAbsence($debut, $fin)
{
    $start = new DateTime($debut);
    $end   = new DateTime(date('Y-m-d',strtotime($fin.'+1days')));

    //Création d'un tableau de dates sur la période d'absence
    $interval = new DateInterval('P1D');
    $period   = new DatePeriod($start ,$interval, $end);
   
    foreach($period as $day) {
        $absences [] =  $day->format('Y-m-d');
    }
   
    return $absences;
}

/**
 * Retourne dans un tableau les dates consécutives de congés
 * d'un employé passé en paramètre
 * et le motif du congé
 * 
 * @param mixed $employe
 * 
 * @return [type]
 */
function getCongesEmploye($employe)
{
    $conges = [];

    $req_all_abs = getAbsUser($employe['empid']);
    $absences = $req_all_abs->fetchAll(PDO::FETCH_ASSOC);

    for($i=0 ; $i < count($absences); $i++) {
        $conges [] = ['periode' => intervalAbsence($absences[$i]['debut'], $absences[$i]['fin']), 'motif' => $absences[$i]['motif']]; 
    }

    return $conges;
}