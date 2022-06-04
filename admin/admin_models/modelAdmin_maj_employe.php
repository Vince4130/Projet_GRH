<?php

/**
 * Mise à jour du profil d'un employé
 * @param mixed $servid
 * @param mixed $fonctid
 * @param mixed $horid
 * @param mixed $id_employe
 * 
 * @return [type]
 */
function updateEmploye($servid, $fonctid, $horid, $id_employe)
{
    $bdd= $GLOBALS['bdd'];
    var_dump($servid); echo "<br>";
    var_dump($fonctid); echo "<br>";
    var_dump($horid); echo "<br>";
    var_dump($servid); echo "<br>"; //die;

    // $update = "UPDATE employe SET horid = $horid, servid = $servid, fonctid = $fonctid WHERE empid = $id_employe";

    // $req_update_empl = $bdd->exec($update);
    
    $req_update_empl = $bdd->prepare("UPDATE employe SET horid =:horid, servid =:servid, fonctid =:fonctid WHERE empid =:empid");

    $req_update_empl->execute(
        [
            'horid'   => (int)$horid,
            'servid'  => (int)$servid,
            'fonctid' => (int)$fonctid,
            'empid'   => (int)$id_employe,
        ]
    );

    return $req_update_empl;
}