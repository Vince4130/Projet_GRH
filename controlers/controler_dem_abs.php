<?php
session_start();

require ('./models/model_dem_abs.php');

function saisieDemandeAbsence()
{ 
    //Congés doivent débuter au minimum le lendemain
    $demain          = date('Y-m-d', strtotime('+1days'));
    $jour            = date('Y-m-d');
    $year            = date('Y');
    $absences        = [];
    $jourNonDecompte = 0;
    $empid           = $_SESSION['id'];
    
    if(isset($_POST['submit'])) {

        if (!empty($_POST['typeabs']) && !empty($_POST['date_deb']) && !empty($_POST['date_fin'])) {

            //Récupération des variables du formulaire
            $motif = filter_input(INPUT_POST, 'typeabs',  FILTER_SANITIZE_SPECIAL_CHARS);
            $debut = filter_input(INPUT_POST, 'date_deb', FILTER_SANITIZE_SPECIAL_CHARS);
            $fin   = filter_input(INPUT_POST, 'date_fin', FILTER_SANITIZE_SPECIAL_CHARS);
            
            $start = new DateTime($debut);
            $end   = new DateTime($fin);

            //Création d'un tableau de date sur la période d'absence
            $interval = new DateInterval('P1D');
            $period   = new DatePeriod($start ,$interval, $end);

            foreach($period as $day) {
                $absences [] =  $day->format('Y-m-d');
            }
                
            $nbAbs = count($absences) + 1;
            
            for($i = 0; $i < $nbAbs; $i++) {
                if(verifJourFerie($absences[$i]) OR verifWeekEnd($absences[$i])) {
                    $jourNonDecompte++;
                }
            }

            //Nombre de jours d'absences réél => pas de we ou jours fériés
            $nbJourAbs = $nbAbs - $jourNonDecompte;

            //Vérification jour de début d'absence >= j+1
            if ($debut < $demain) {
                
                $erreur = true;
                $text_erreur = "Une absence doit être demandée au moins la veille";

            } else {
                
                //Absence au moins 1 jour
                if ($debut <= $fin) {
                  
                    //Récupération du solde de jours selon motif d'absences
                    $tab_abs = getAbsences($empid);
                    
                    foreach($tab_abs as $abs) {      
                        if($abs['libelle'] == $motif) {
                           $soldeJours = (int)($abs['nbjours']);
                           $typeid     = (int)($abs['typeid']);
                        }
                    }
                    
                    if($soldeJours > 0) {
                        
                        if($soldeJours >= $nbJourAbs) {
                            
                            $dem_abs = demandeAbs($empid, $typeid, $jour, $debut, $fin, $year, $nbJourAbs);
                            
                            if($dem_abs != 1) {
                                $erreur      = true;
                                $text_erreur = "Votre demande d'absence n'a pas été enregistrée";
                            } else {
                                $erreur      = false;
                                $text_erreur = "Demande d'absence enregistrée, en attente de validation";
                            }
                            
                        } else {
                            $erreur      = true;
                            $text_erreur = "Solde insuffisant, il vous reste : $soldeJours jour(s) de ".strtolower($motif);
                        }

                    } else {
                        $erreur      = true;
                        $text_erreur = "Solde de ".strtolower($motif)." épuisé";
                    }
        
                        
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