<?php

function saisieDemandeAbsence()
{ 
    if(isset($_POST['submit'])) {

        if (isset($_POST['type_abs']) && isset($_POST['date_deb']) && isset($_POST['date_fin'])) {

            $motif = $_POST['type_abs'];
            $debut = $_POST['date_deb'];
            $fin   = $_POST['date_fin'];
        }
    }
    require('./views/view_dem_abs.php');
}