<?php

include_once('./includes/inc_param.php');

function getCredit($id)
{

    $bdd = $GLOBALS['bdd'];

    $req_credit = $bdd->query("SELECT TIME_FORMAT(p.h_arrivee, '%H:%i') AS 'Heure Arrivée', TIME_FORMAT(p.h_depart, '%H:%i') AS 'Heure Départ',
                                TIME_FORMAT(TIMEDIFF(p.h_mer2, p.h_mer1), '%H:%i') AS 'Pause méridienne', TIME_FORMAT(mh.hormod, '%H:%i') AS 'Module horaire',
                                TIME_FORMAT(TIMEDIFF(TIMEDIFF(p.h_depart, p.h_arrivee), TIMEDIFF(p.h_mer2, p.h_mer1)), '%H:%i') AS 'Temps réalisé'
                                FROM pointage p, employe e, mod_horaire mh
                                WHERE p.empid = e.empid AND e.horid = mh.horid AND e.empid = $id ORDER BY p.pointdate");

    return $req_credit;
}


/**
 * Retourne les absences d'un employé par son id
 * sur l'année en cours
 * @param mixed $id
 * 
 * @return [type]
 */
function getAbsences($id)
{
    $bdd = $GLOBALS['bdd'];

    $year = date('Y');

    $req_absences = $bdd->prepare("SELECT tc.id AS 'typeid', tc.libelle AS 'libelle', dc.nb_jours AS 'nbjours' FROM type_conge tc, droits_conges dc, employe e WHERE dc.empid = e.empid AND dc.typeid = tc.id AND e.empid =:empid AND dc.annee =:annee");

    $req_absences->execute(
        [
            'empid' => $id,
            'annee' => $year,
        ]
    );

    $tab_absences = $req_absences->fetchAll(PDO::FETCH_ASSOC);

    return $tab_absences;
}