<?php

// function histoPointage($id)
// {

//     $bdd = $GLOBALS['bdd'];

//     $req_histo = $bdd->query("SELECT DATE_FORMAT(p.pointdate,'%d/%m/%Y') AS 'Date', TIME_FORMAT(p.h_arrivee, '%H:%i') AS 'Heure Arrivée', TIME_FORMAT(p.h_depart, '%H:%i') AS 'Heure Départ',
//                                 TIME_FORMAT(TIMEDIFF(p.h_mer2, p.h_mer1), '%H:%i') AS 'Pause méridienne', TIME_FORMAT(mh.hormod, '%H:%i') AS 'Module horaire',
//                                 TIME_FORMAT(TIMEDIFF(TIMEDIFF(p.h_depart, p.h_arrivee), TIMEDIFF(p.h_mer2, p.h_mer1)), '%H:%i') AS 'Temps réalisé', p.pointid AS 'point_id'
//                                 FROM pointage p, employe e, mod_horaire mh
//                                 WHERE p.empid = e.empid AND e.horid = mh.horid AND e.empid = $id ORDER BY p.pointdate");

//     return $req_histo;
// }


/**
 * 
 * Retourne l'ensemble des pointages d'un employé
 * en fonction de son id
 *
 * @param  int $id
 * @return object
 */
function histoPointage($id)
{

    $bdd = $GLOBALS['bdd'];

    $req_histo = $bdd->query("SELECT DATE_FORMAT(p.pointdate,'%d/%m/%Y') AS 'Date', TIME_FORMAT(p.h_arrivee, '%H:%i') AS 'Heure Arrivée', TIME_FORMAT(p.h_depart, '%H:%i') AS 'Heure Départ',
                                TIME_FORMAT(TIMEDIFF(p.h_mer2, p.h_mer1), '%H:%i') AS 'Pause méridienne', TIME_FORMAT(mh.hormod, '%H:%i') AS 'Module horaire',
                                TIME_FORMAT(TIMEDIFF(TIMEDIFF(p.h_depart, p.h_arrivee), CASE WHEN TIMEDIFF(p.h_mer2, p.h_mer1) < '00:45:00' THEN '00:45:00' ELSE TIMEDIFF(p.h_mer2, p.h_mer1) END), '%H:%i') AS 'Temps réalisé', p.pointid AS 'point_id'
                                FROM pointage p, employe e, mod_horaire mh
                                WHERE p.empid = e.empid AND e.horid = mh.horid AND e.empid = $id ORDER BY p.pointdate");

    return $req_histo;
}


/**
 * Retourne le nombre de pointage
 * d'un employé
 *
 * @param  mixed $id
 * @return void
 */
function lignesPointage($id)
{

    $bdd = $GLOBALS['bdd'];

    $req_lignes = $bdd->query("SELECT count(pointid) AS 'nbLignes' FROM pointage WHERE empid = $id");

    $rowNumbers = $req_lignes->fetch(PDO::FETCH_ASSOC);

    return $rowNumbers['nbLignes'];
}

/**
 * creditAnterieur
 * Retourne le crédit anterieur
 * enregistré au moment de la création de l'employé
 * 
 * @param  int $id
 * @return object
 */
function creditAnterieur($id)
{

    $bdd = $GLOBALS['bdd'];

    $req_credit = $bdd->prepare("SELECT * FROM credit_ant WHERE empid=:empid");

    $req_credit->execute(['empid' => $id]);

    return $req_credit;
}
