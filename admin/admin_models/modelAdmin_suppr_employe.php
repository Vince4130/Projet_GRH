<?php


function deleteEmploye($empid)
{
    $bdd = $GLOBALS['bdd'];

    $req_delete_employe = $bdd->prepare("DELETE FROM employe WHERE empid =:empid");

    $req_delete_employe->execute(['empid' => $empid]);

    return $req_delete_employe;
}