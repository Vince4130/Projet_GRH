<?php

/**
 * Retourne l'ensemble des demandes d'absences
 * des employés
 * 
 * @return [type]
 */
function getAllDemAbs()
{
    $bdd = $GLOBALS['bdd'];

    $req_all_dem_abs = $bdd->prepare("SELECT * FROM demande_absence da, employe e, type_conge tc WHERE da.empid = e.empid AND da.typeid = tc.id ORDER BY da.date_dem DESC, e.nom ASC, e.prenom ASC");

    $req_all_dem_abs->execute();

    // $liste_dem_abs = $req_all_dem_abs->fetchAll(PDO::FETCH_ASSOC);

    return   $req_all_dem_abs;
}

/**
 * Retourne l'ensemble des demandes d'absences
 * des employés en attente
 * 
 * @return [type]
 */
function getAllDemAbsAttente() 
{
    $bdd = $GLOBALS['bdd'];

    $req_all_dem_abs_att = $bdd->prepare("SELECT * FROM demande_absence da, employe e, type_conge tc WHERE da.empid = e.empid AND da.typeid = tc.id AND da.etat = 'En attente' ORDER BY da.date_dem, e.nom ASC, e.prenom ASC");

    $req_all_dem_abs_att->execute();

    return  $req_all_dem_abs_att;
}

/**
 * Retourne une demande d'absence en fonction id
 * 
 * @param int $id
 * 
 * @return [type]
 */
function getDemAbs($id)
{
    $bdd = $GLOBALS['bdd'];

    $req_dem_abs = $bdd->prepare("SELECT * FROM demande_absence WHERE demabsid =:demabsid");

    $req_dem_abs->execute(['demabsid' => $id]);

    return $req_dem_abs;
}

/**
 * Mise à jour d'une demande d'absence
 * d'un employé
 * 
 * @param int $id
 * @param string $etat
 * 
 * @return [type]
 */
function updateDemAbs($id, $etat)
{
    $bdd = $GLOBALS['bdd'];
   
    $req_update_dem_abs = $bdd->prepare("UPDATE demande_absence SET etat =:etat WHERE demabsid =:demabsid");

    $req_update_dem_abs->execute(
        [
            'etat' => "$etat",
            'demabsid' => $id,
        ]
    );
    return $req_update_dem_abs;
}

/**
 * Insertion d'un congés
 * en fonction de id d'une demande d'absence
 * 
 * @param int $id
 * 
 * @return [type]
 */
function insertConges($id)
{
    $bdd = $GLOBALS['bdd'];

    $req_dem_abs = getDemAbs($id);

    $dem_abs = $req_dem_abs->fetch(PDO::FETCH_ASSOC);
    
    $date_deb = $dem_abs['date_deb'];
    $date_fin = $dem_abs['date_fin'];
    $empid    = (int)$dem_abs['empid'];
    $typeid   = (int)($dem_abs['typeid']);

    $req_insert_conges = $bdd->prepare("INSERT INTO conges VALUES (:congeid, :date_deb, :date_fin, :empid, :typeid)");

    $req_insert_conges->execute(
        [
            'congeid'  => NULL,
            'date_deb' => "$date_deb",
            'date_fin' => "$date_fin",
            'empid'    => $empid,
            'typeid'   => $typeid,
        ]
    );

    return $req_insert_conges;
}

/**
 * Mise à jour des droits d'absences
 * en fonction id d'une demande d'absence
 * 
 * @param int $id
 * 
 * @return [type]
 */
function updateDroitsConges($id)
{
    $bdd = $GLOBALS['bdd'];

    $req_dem_abs = getDemAbs($id);

    $dem_abs = $req_dem_abs->fetch(PDO::FETCH_ASSOC);

    $empid    = (int)($dem_abs['empid']);
    $typeid   = (int)($dem_abs['typeid']);
    $nb_jours = (int)($dem_abs['nb_j']);

    $req_update_droits = $bdd->prepare("UPDATE droits_conges SET nb_jours = nb_jours - :nb_jours WHERE empid = :empid AND typeid = :typeid");

    $req_update_droits->execute(
        [
            'nb_jours' => $nb_jours,
            'empid'    => $empid,
            'typeid'   => $typeid,
        ]
    );
    
    return $req_update_droits;
}

