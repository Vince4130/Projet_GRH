<?php
session_start();

function saisieDemandeAbsence()
{ 
    //Congés doivent débuter au minimum le lendemain
    $demain          = date('Y-m-d', strtotime('+1days'));
    $absences        = [];
    $jourNonDecompte = 0;

    if(isset($_POST['submit'])) {

        if (!empty($_POST['typeabs']) && !empty($_POST['date_deb']) && !empty($_POST['date_fin'])) {

            //Récupération des variables du formulaire
            $motif = filter_input(INPUT_POST, 'typeabs', FILTER_SANITIZE_SPECIAL_CHARS);
            $debut = new DateTime($_POST['date_deb']);
            $fin   = new DateTime($_POST['date_fin']);

            $_SESSION['debut'] = $_POST['date_deb'];
            $_SESSION['fin']   = $_POST['date_fin'];

            //Création d'un tableau de date sur l'intervalle
            $interval = new DateInterval('P1D');
            $period   = new DatePeriod($debut ,$interval, $fin);

            foreach($period as $day) {
                $absences [] =  $day->format('Y-m-d');
            }
                
            $nbAbs = count($absences) + 1;
            
            for($i = 0; $i < $nbAbs; $i++) {
                if(verifJourFerie($absences[$i]) OR verifWeekEnd($absences[$i])) {
                    $jourNonDecompte++;
                }
            }

            $nbJourAbs = $nbAbs - $jourNonDecompte;

            //Vérification jour de début d'absence > j+1
            if ($debut < $demain) {
                $erreur = true;
                $text_erreur = "Une absence doit être demandée au moins la veille";
            } else {
                
                //Absence au moins 1 jour
                if ($debut <= $fin) {
                    $erreur = false;
                    echo $nbJourAbs;
                        
                } else {
                    $erreur      = true;
                    $text_erreur = "Date de fin erronée";
                }
            }

        } else {
            $erreur      = true;
            $text_erreur = "Veuillez compléter tous les champs";
        }
        
    }

    require('./views/view_dem_abs.php');
}