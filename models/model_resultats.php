<?php

function insertPointage($jour, $ha, $p1, $p2, $hd, $id) 
{
    
    $bdd = $GLOBALS['bdd'];

    $req_insert_pointage = $bdd->prepare("INSERT INTO pointage VALUES (:id, :pointdate, :ha, :hm1, :hm2, :hd, :empid)");

    $req_insert_pointage->execute(
        [
            'id'        => NULL,
            'pointdate' => "$jour",
            'ha'        => "$ha",
            'hm1'       => "$p1",
            'hm2'       => "$p2",
            'hd'        => "$hd",
            'empid'     => $id,     
        ]);
    
    return $req_insert_pointage;
}


function existPointage ($jour, $id)
{

    $bdd = $GLOBALS['bdd'];

    $req_deja_pointe = "SELECT * FROM pointage p, employe e WHERE e.empid = p.empid AND e.empid = $id AND p.pointdate = '$jour'";

    $result = $bdd->query($req_deja_pointe);

    $dejapointe = $result->rowCount();

    return $dejapointe;
}