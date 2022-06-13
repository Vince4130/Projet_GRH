<?php

function getListeRH()
{
    $bdd = $GLOBALS['bdd'];

    $req_list_rh = $bdd->query("SELECT * FROM admin ORDER BY nom, prenom ASC");

    $liste_rh = $req_list_rh->fetchAll(PDO::FETCH_ASSOC);

    return $liste_rh;
}

function deleteRH($adminid)
{
    $bdd = $GLOBALS['bdd'];
    
    $req_delete_rh = $bdd->prepare("DELETE FROM admin WHERE adminid =:adminid");

    $req_delete_rh->execute(['adminid' => $adminid]);

    return $req_delete_rh;
}

function estAdmin($id)
{
    $bdd = $GLOBALS['bdd'];

    $req_admin = $bdd->prepare("SELECT estAdmin FROM admin WHERE adminid =:adminid AND estAdmin =:estAdmin");

    return $req_admin->execute(
                [
                    'adminid'  => intval($id),
                    'estAdmin' => true,
                ]
            );


}