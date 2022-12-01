<?php

// require('./models/model_histo_point.php');
include_once('./includes/inc_functions.php');
require('./classes/pagination.class.php');

function historiquePointage()
{

    $id = $_SESSION['id'];
    
    if(!empty($id)) {

        $req_histo_point = histoPointage($id);

        $req_credit_ant = creditAnterieur($id);

        $credit_ant = $req_credit_ant->fetch(PDO::FETCH_ASSOC);

        $nbLignes = $req_histo_point->rowCount();

        $nbLignesPage = 10;

        $tabResult = $req_histo_point->fetchAll(PDO::FETCH_ASSOC);

        ///////////////////////////////////////////////////////////////////////////////////////////////
        ///// Construction du tableau pour affichage de l'historique avec cumul des soldes horaires
        ///////////////////////////////////////////////////////////////////////////////////////////////

        $cumul = 0;

        for ($i = 0; $i < $nbLignes; $i++) {

            $date          = $tabResult[$i]['Date']; 
            $h_arrivee     = $tabResult[$i]['Heure Arrivée'];
            $h_depart      = $tabResult[$i]['Heure Départ'];
            $pause         = $tabResult[$i]['Pause méridienne'];
            $mod_horaire   = $tabResult[$i]['Module horaire'];
            $temps_realise = $tabResult[$i]['Temps réalisé'];
            $point_id      = $tabResult[$i]['point_id'];

            //Calcul du solde avec la fonction calculerCredit includes/inc_functions
            $solde = calculerCredit(timeTosecond($h_arrivee), timeTosecond($h_depart), timeTosecond($pause), timeTosecond($mod_horaire));

            //Mise en forme du cumul pour affichage
            if ($solde[0] == "-") {
                
                $soldeF = timeTosecond(substr($solde, 1));
                $cumul += ($soldeF * -1);             
            
            } else {

                $soldeF = timeTosecond($solde);
                $cumul += $soldeF;
            }
                
            if ($cumul < 0) {
                $format_cumul = "-".gmdate('H:i', ($cumul*-1));
            } else  {
                $format_cumul = gmdate('H:i', $cumul);
            }

            //Vérification si modification de pointage en attente, refusée ou acceptée
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
            
            //Insertion des valeurs dans un tableau pour affichage
            $tab[] = array($date, $h_arrivee, $h_depart, $mod_horaire, $temps_realise, $pause, $solde, $format_cumul, $point_id);
        }

        if (!empty($tab)) {
            $tab = array_reverse($tab);
        }


        ///////////////////////////////////////////////////////////////////////////////////////////////
        ////    Gestion des pages
        ///////////////////////////////////////////////////////////////////////////////////////////////

        if(isset($_GET['page']) && !empty($_GET['page'])) {
            $page = $_GET['page'];
        } else {
            $page = 1;
        }
        
        if($nbLignes == 0) {
            $nbLignes = 1;
        }
        
        $mapage = new Pagination($page);
        
        $mapage->setNbPages($nbLignesPage, $nbLignes);
        $mapage->setRecords($nbLignes);
        $mapage->setNbLignesPages($nbLignesPage);


        ///////////////////////////////////////////////////////////////////////////////////////////////
        ////    Gestion des lignes
        ///////////////////////////////////////////////////////////////////////////////////////////////

        // $firstLine = $mapage->firstLine();
        // $lastLine  = $mapage->lastLine();
        
            
        require('./views/view_histo_point.php');
    
    } else {
        header('Location: index.php?action=accueil');
        exit();
    }
}