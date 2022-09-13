<?php

/**
 * 
 * Authentification d'un 
 * employé dans la base de données
 * @param  mixed $login
 * @param  mixed $passwrd
 * @return void
 */
function connectUser($login, $passwrd)
{

    $bdd = $GLOBALS['bdd'];

    $req_autent = $bdd->prepare("SELECT * FROM employe WHERE ident = :ident AND mdpass = :mdpass");

    $req_autent->execute(
        [
            "ident" => "$login",
            "mdpass" => "$passwrd",
        ]
    );

    return $req_autent;
}


/**
 * 
 * Retourne le module horaire
 * d'un employé en fonction de son id
 *
 * @param  int $id
 * @return void
 */
function getModuleHoraire($id)
{

    $bdd = $GLOBALS['bdd'];    

    $req_mod_hor = $bdd->query("SELECT TIME_FORMAT(mh.hormod, '%H:%i') AS 'Mod_Hor' FROM  mod_horaire mh, employe e WHERE e.empid = $id AND mh.horid = e.horid");
    
    return $req_mod_hor;
}


// /**
//  * 
//  * Retourne l'ensemble des pointages d'un employé
//  * en fonction de son id
//  *
//  * @param  int $id
//  * @return void
//  */
// function histoPointage($id)
// {

//     $bdd = $GLOBALS['bdd'];

//     $req_histo = $bdd->query("SELECT DATE_FORMAT(p.pointdate,'%d/%m/%Y') AS 'Date', TIME_FORMAT(p.h_arrivee, '%H:%i') AS 'Heure Arrivée', TIME_FORMAT(p.h_depart, '%H:%i') AS 'Heure Départ',
//                                 TIME_FORMAT(TIMEDIFF(p.h_mer2, p.h_mer1), '%H:%i') AS 'Pause méridienne', TIME_FORMAT(mh.hormod, '%H:%i') AS 'Module horaire',
//                                 TIME_FORMAT(TIMEDIFF(TIMEDIFF(p.h_depart, p.h_arrivee), CASE WHEN TIMEDIFF(p.h_mer2, p.h_mer1) < '00:45:00' THEN '00:45:00' ELSE TIMEDIFF(p.h_mer2, p.h_mer1) END), '%H:%i') AS 'Temps réalisé', p.pointid AS 'point_id'
//                                 FROM pointage p, employe e, mod_horaire mh
//                                 WHERE p.empid = e.empid AND e.horid = mh.horid AND e.empid = $id ORDER BY p.pointdate");

//     return $req_histo;
// }
