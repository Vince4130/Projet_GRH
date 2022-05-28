<?php

function getDemAbsUser($id)
{
    $bdd = $GLOBALS['bdd'];

    $req_dem_abs = $bdd->prepare("SELECT * FROM demande_absence da, type_conge tc WHERE empid =:empid AND da.typeid = tc.id");

    $req_dem_abs->execute(
        [
            'empid' => $id,
        ]
    );

    return $req_dem_abs;
}

function deleteDemAbs($id) 
{
    $bdd = $GLOBALS['bdd'];
    
    $req_delete_dem = $bdd->prepare("DELETE FROM demande_absence WHERE demabsid =:id");

    $req_delete_dem->execute(['id' => $id]);
    
    return $req_delete_dem;
}