<?php

function getAllDemAbs()
{
    $bdd = $GLOBALS['bdd'];

    $req_all_dem_abs = $bdd->prepare("SELECT * FROM demande_absence da, employe e, type_conge tc WHERE da.empid = e.empid AND da.typeid = tc.id AND da.etat = 'En attente' ORDER BY da.date_dem DESC, e.nom ASC, e.prenom ASC");

    $req_all_dem_abs->execute();

    return $req_all_dem_abs;
}

function getDemAbs($demabsid)
{
    $bdd = $GLOBALS['bdd'];

    $req_dem_abs = $bdd->prepare("SELECT * FROM demande_absence WHERE demabsid =:demabsid");

    $req_dem_abs->execute(['demabsid' => (int)($demabsid)]);

    return $req_dem_abs;
}

function updateDemAbs($demabsid, $etat)
{
    $bdd = $GLOBALS['bdd'];

    $req_dem_abs = getDemAbs($demabsid);

    $dem_abs = $req_dem_abs->fetch(PDO::FETCH_ASSOC);

    $req_update_dem_abs = $bdd->prepare("UPDATE demande_absence SET etat =:etat WHERE demabsid =:demabsid");

    $req_update_dem_abs->execute(
        [
            'etat' => "$etat",
            'demabsid' => intval($demabsid),
        ]
    );
    return $req_all_dem_abs;
}

function insertConges($demabsid)
{
    $bdd = $GLOBALS['bdd'];

    $req_dem_abs = getDemAbs($demabsid);

    $dem_abs = $req_dem_abs->fetchAll(PDO::FETCH_ASSOC);
    echo "<pre>"; var_dump($dem_abs);
    $date_deb = $dem_abs['date_deb'];
    $date_fin = $dem_abs['date_fin'];
    $empid    = (int)($dem_abs['empid']);
    $typeid   = (int)($dem_abs['typeid']);

    $req_insert_conges = $bdd->prepare("INSERT INTO conges VALUES ( :congeid, :date_deb, :date_fin, :empid, :typeid");

    $req_insert_conges->execute(
        [
            'congeid'  => NULL,
            'date_deb' => "$date_deb",
            'date_fin' => "$date_fin",
            'empid'    => $empid,
            'typeid'   => $typeid,
        ]
    );
}

function updateDroitsConges($demasbsid)
{
    $bdd = $GLOBALS['bdd'];

    $req_dem_abs = getDemAbs($demasbsid);

    $dem_abs = $req_dem_abs->fetchAll(PDO::FETCH_ASSOC);

    $empid    = intval($dem_abs['empid']);
    $typeid   = intval($dem_abs['typeid']);
    $nb_jours = intval($dem_abs['nb_j']);

    $req_update_droits = $bdd->prepare("UPDATE droits_conges SET nb_jours = nb_jours - :nb_jours WHERE empid = :empid AND typeid = :typeid");

    $req_update_droits->execute(
        [
            'nb_jours' => $nb_jours,
            'empid'    => $empid,
            'typeid'   => $typeid,
        ]
        );
}

