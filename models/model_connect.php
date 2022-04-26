<?php

include_once('../includes/inc_param.php');

require_once('../includes/inc_functions.php');

function connectUser($login, $passwrd) {

    $bdd = connexDB('grh');

    $req_autent =  $bdd->prepare("SELECT * FROM employe WHERE ident = :ident AND mdpass = :mdpass");

    $req_autent->execute(
        [
            "ident"  =>  "$login",
            "mdpass" =>  "$passwrd",
        ]
    );

    return $req_autent;
}

function getModuleHoraire($id, $horid) {

    $bdd = connexDB('grh');

    $req_mod_hor = $bdd->query("SELECT hormod FROM  mod_horaire mh, employe e WHERE e.empid = $id AND mh.horid = e.horid");

    return $req_mod_hor;
}

function histoPointage($id) {

    $bdd = connexDB('grh');
    
    $req_histo = $bdd->query("SELECT DATE_FORMAT(p.pointdate,'%d/%m/%Y') AS 'Date', TIME_FORMAT(p.h_arrivee, '%H:%i') AS 'Heure Arrivée', TIME_FORMAT(p.h_depart, '%H:%i') AS 'Heure Départ',
                                TIME_FORMAT(TIMEDIFF(p.h_mer2, p.h_mer1), '%H:%i') AS 'Pause méridienne', TIME_FORMAT(mh.hormod, '%H:%i') AS 'Module horaire',
                                TIME_FORMAT(TIMEDIFF(TIMEDIFF(p.h_depart, p.h_arrivee), TIMEDIFF(p.h_mer2, p.h_mer1)), '%H:%i') AS 'Temps réalisé'
                                FROM pointage p, employe e, mod_horaire mh
                                WHERE p.empid = e.empid AND e.horid = mh.horid AND e.empid = $id ORDER BY p.pointdate");

    return $req_histo;
}
