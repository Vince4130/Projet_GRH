<?php

/**
 * Retourne la liste des responsables RH
 * 
 *
 * @return void
 */
function getListeRH()
{
    $bdd = $GLOBALS['bdd'];

    $req_list_rh = $bdd->query("SELECT * FROM admin ORDER BY nom, prenom ASC");
    
    return $req_list_rh;
}


/**
 *  Supprimme le respponsable RH
 * dont l'id est passé en paramètre
 *
 * @param  mixed $adminid
 * @return void
 */
function deleteRH($adminid)
{
    $bdd = $GLOBALS['bdd'];
    
    $req_delete_rh = $bdd->prepare("DELETE FROM admin WHERE adminid =:adminid");

    $req_delete_rh->execute(['adminid' => $adminid]);

    return $req_delete_rh;
}


/**
 * Permet de passer un reponsable RH
 * en admin
 *
 * @param  mixed $id
 * @return void
 */
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