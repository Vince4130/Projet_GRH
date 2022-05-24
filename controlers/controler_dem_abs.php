<?php

function saisieDemandeAbsence()
{ 
    if(isset($_POST['submit'])) {

        if (isset($_POST['typeabs']) && isset($_POST['date_deb']) && isset($_POST['date_fin'])) {

            $motif = filter_input(INPUT_POST, 'typeabs', FILTER_SANITIZE_SPECIAL_CHARS);
            $debut = new DateTime($_POST['date_deb']);
            $fin   = new DateTime($_POST['date_fin']);
           
            $interval = new DateInterval('P1D');
            $period   = new DatePeriod($debut ,$interval, $fin);

            foreach($period as $day) {
                $absences [] = $day->format('Y-m-d'); 
            }

            $nbJoursAbs = count($absences);
            var_dump($nbJoursAbs); echo "<br>";
            echo "<pre>"; var_dump($absences);
        }
    }
    require('./views/view_dem_abs.php');
}