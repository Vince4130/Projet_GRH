<?php

// include('./includes/inc_functions.php');

require('./models/model_welcome.php');

function welcome()
{
 
    $id = $_SESSION['id'];

    ///////////////////////////////////////////////////////////////////////////////////////////////
    ///// Calcul du cumul des soldes horaires
    ///////////////////////////////////////////////////////////////////////////////////////////////
    
    if(!empty($id)) {

        $req_credit = getCredit($id);

        $rows = $req_credit->rowCount();

        $tabResult = $req_credit->fetchAll(PDO::FETCH_ASSOC);

        $_SESSION['userConnecte'] = true;

        //Initialisation du cumul
        $cumul = 0;

        for ($i = 0; $i < $rows; $i++) {

            $h_arrivee = $tabResult[$i]['Heure Arrivée'];
            $h_depart = $tabResult[$i]['Heure Départ'];
            $pause = $tabResult[$i]['Pause méridienne'];
            $mod_horaire = $tabResult[$i]['Module horaire'];
            $temps_realise = $tabResult[$i]['Temps réalisé'];
            // $point_id = $tabResult[$i]['point_id'];

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
        }

        $tababsences = getAbsences($id);
        
        $req_credit->closeCursor();
        
        require('./views/view_welcome.php');
    } else {
        header('Location: index.php?action=accueil');
        exit();
    }
}