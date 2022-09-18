<?php

function existPointage ($jour, $id)
{

    $bdd = $GLOBALS['bdd'];

    $req_deja_pointe = "SELECT * FROM pointage p, employe e WHERE e.empid = p.empid AND e.empid = $id AND p.pointdate = '$jour'";

    $result = $bdd->query($req_deja_pointe);

    $dejapointe = $result->rowCount();

    return $dejapointe;
}