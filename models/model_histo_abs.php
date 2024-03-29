<?php

/**
 * Retourne les dates de début et 
 * de fin des absences d'un employé 
 * à partir de son id
 *
 * @param  int $id
 * @return object
 */
function getAbsUser($id)
{
    $bdd = $GLOBALS['bdd'];

    $req_abs = $bdd->prepare("SELECT c.date_deb AS 'debut', c.date_fin AS 'fin', tc.libelle AS 'motif', tc.id AS 'id' FROM conges c, type_conge tc, employe e WHERE c.empid = e.empid AND c.typeid = tc.id AND e.empid =:empid ORDER BY c.date_deb DESC");

    $req_abs->execute(
        [
            'empid' => $id,
        ]
    );

    return $req_abs;
}

// (DATEDIFF(c.date_fin, c.date_deb) + 1) AS 'jours' 

// SELECT * FROM conges c, type_conge tc, employe e WHERE c.empid = e.empid AND c.typeid = tc.id AND e.empid = 1 ORDER BY c.date_deb DESC
// SELECT DATEDIFF('2022-06-02', '2022-06-01') AS 'nb jours' FROM conges WHERE empid=1 AND typeid = 1