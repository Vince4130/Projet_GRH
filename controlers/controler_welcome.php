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
    } else {
        header('Location: index.php?action=accueil');
        exit();
    }
}