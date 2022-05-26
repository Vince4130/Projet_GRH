<?php

function getAllDemAbs()
{
    $bdd = $GLOBALS['bdd'];

    $req_all_dem_abs = $bdd->prepare("SELECT * FROM demande_absence da, employe e WHERE da.empid = e.empid ORDER BY da.date_dem DESC, e.nom ASC, e.prenom ASC");

    $req_all_dem_abs->execute();

    return $req_all_dem_abs;
}
