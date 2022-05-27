<?php

function getAllDemAbs()
{
    $bdd = $GLOBALS['bdd'];

    $req_all_dem_abs = $bdd->prepare("SELECT * FROM demande_absence da, employe e, type_conge tc WHERE da.empid = e.empid AND da.typeid = tc.id ORDER BY da.date_dem DESC, e.nom ASC, e.prenom ASC");

    $req_all_dem_abs->execute();

    return $req_all_dem_abs;
}

function getDemAbs($demabsid)
{
    $bdd = $GLOBALS['bdd'];

    $req_dem_abs = $bdd->prepare("SELECT * FROM demande_absence WHERE demabsid =:demabsid");

    $req_dem_abs->execute(['demabsid' => $demabsid]);

    return $req_dem_abs;
}

function updateDemAbs($demabsid)
{
    $bdd = $GLOBALS['bdd'];

    $req_dem_abs = getDemAbs($demabsid);

    $dem_abs = $req_dem_abs->fetch(PDO::FETCH_ASSOC);

    var_dump($dem_abs); die;

    $req_update_dem_abs = $bdd->prepare("");
}


