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
