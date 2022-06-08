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

        // $submit = $_POST['submit'];

        // if ($submit == "Effacer") {
        //     $_POST['date_deb'] = "";
        //     $_POST['date_fin'] = "";
        // }

        if (!empty($_POST['typeabs']) && !empty($_POST['date_deb']) && !empty($_POST['date_fin'])) {
            
            //Récupération des variables du formulaire
            $motif = filter_input(INPUT_POST, 'typeabs',  FILTER_SANITIZE_SPECIAL_CHARS);
            $debut = filter_input(INPUT_POST, 'date_deb', FILTER_SANITIZE_SPECIAL_CHARS);
            $fin   = filter_input(INPUT_POST, 'date_fin', FILTER_SANITIZE_SPECIAL_CHARS);

            //Récupération du solde de jours selon motif d'absences
            $tab_abs = getAbsences($empid);
                    
            foreach($tab_abs as $abs) {      
                if($abs['libelle'] == $motif) {
                   $soldeJours = (int)($abs['nbjours']);
                   $typeid     = (int)($abs['typeid']);
                }
            } 

            //Si le solde de jour concernant le motif est épuisé
            if ($soldeJours == 0) {
                    $erreur = true;
                    $text_erreur = "Solde de ".strtolower($motif)." épuisé";
            } 
            
                else {

                    $weekend = verifWeekEnd($debut);
                    $ferie   = verifJourFerie($debut);

                    //Vérification : conges ou demande déjà déposés pour cette période
                    $exist_dem = existDemande($debut, $fin, $empid);
                    $exist_abs = existAbsence($debut, $fin, $empid);
                    
                    $demande = $exist_dem->fetch(PDO::FETCH_ASSOC);
                    $absence = $exist_abs->fetch(PDO::FETCH_ASSOC);
                    
                    //Si pas de demande d'absence ou d'absence sur la période
                    if ($demande OR $absence) {
                        
                        if($demande) {
                            $type_d      = intval($demande['typeid']);
                            $type_dem    = getTypeAbs($type_d)->fetch(PDO::FETCH_ASSOC);
                            $erreur      = true;
                            $text_erreur = "Du ".formatDate(inverseDate($demande['date_deb']))." au ".formatDate(inverseDate($demande['date_fin'])). " il existe une demande de ".strtolower($type_dem['libelle'])." (statut : ".strtolower($demande['etat'])."), veuillez saisir une autre période";
                        } 

                        elseif($absence) {                    
                            $type_a      = intval($absence['typeid']);
                            $type_abs    = getTypeAbs($type_a)->fetch(PDO::FETCH_ASSOC);
                            $erreur      = true;
                            $text_erreur = "Du ".formatDate(inverseDate($demande['date_deb']))." au ".formatDate(inverseDate($demande['date_fin'])). " vous êtes en ".$typeabs['libelle'];
                        } 
                    } 
                        else {

                            if ($weekend OR $ferie) {
                                $erreur      = true;
                                $text_erreur = "Une absence ne peut pas débuter un jour de week-end ou un jour férié";
                            } 
                            
                            else {

                                //Vérification jour de début d'absence >= j+1
                                if ($debut < $demain) {                   
                                    $erreur      = true;
                                    $text_erreur = "Une absence doit être demandée au moins la veille";
                                } else {
                                
                                    //Absence >= 1 jour
                                    if ($debut <= $fin) {

                                        //Calcul du nombre de jours ouvrés
                                        $nbJourAbs = calculJourOuvres($debut, $fin);

                                        //Si solde suffisant par rapport au nombre de jours demandés
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
                                        $text_erreur = "Date de fin antérieure à la date de début";
                                        }
                                }
                            }
                        }
                    }   //Fin si solde jours = 0

        } else {
            $erreur      = true;
            $text_erreur = "Veuillez compléter tous les champs";
            }
        
    } //Fin si submit

    require('./views/view_dem_abs.php');
}