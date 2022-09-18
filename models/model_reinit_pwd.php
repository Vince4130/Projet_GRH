<?php

/**
 * Mise à jour du mot de passe
 * d'un employé
 *
 * @param  int $id
 * @param  string $pwd
 * @return void
 */
function updatePwd($id, $pwd)
{
    $bdd = $GLOBALS['bdd'];

    $pwd = $bdd->quote($pwd);

    $update = "UPDATE employe SET mdpass = $pwd WHERE empid = $id";

    $req_update_pwd = $bdd->exec($update);
    
    return $req_update_pwd;
}