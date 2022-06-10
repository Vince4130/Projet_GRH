<?php

function getAbsUser($id)
{
    $bdd = $GLOBALS['bdd'];

    $req_abs = $bdd->prepare("SELECT c.date_deb AS 'debut', c.date_fin AS 'fin', tc.libelle AS 'motif' FROM conges c, type_conge tc, employe e WHERE c.empid = e.empid AND c.typeid = tc.id AND e.empid =:empid ORDER BY c.date_deb DESC");

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