<?php

function updatePwd($id, $pwd)
{
    $bdd = $GLOBALS['bdd'];

    $pwd = $bdd->quote($pwd);

    $update = "UPDATE employe SET mdpass = $pwd WHERE empid = $id";

    $req_update_pwd = $bdd->exec($update);
    
    return $req_update_pwd;
}