<?php

function getLibelleService($servid)
{
    $bdd = $GLOBALS['bdd'];

    $req_lib_service = $bdd->prepare("SELECT libelle FROM service WHERE servid = :servid");

    $req_lib_service->execute(['servid' => $servid]);

    $service =  $req_lib_service->fetchAll(PDO::FETCH_ASSOC);

    return $service['libelle'];
}


function getLibelleFonction($id)
{
    $bdd = $GLOBALS['bdd'];

    $req_lib_fonction = $bdd->prepare("SELECT libelle FROM fonction WHERE fonctid = :fonctid");

    $req_lib_fonction->execute(['fonctid' => $id]);

    $fonction = "fonction";
    // $fonction =  $req_lib_fonction->fetch(PDO::FETCH_ASSOC);
    // var_dump($fonction); 
    // echo "fonction"; die;
    return $fonction;
}