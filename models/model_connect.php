<?php

/**
 * 
 * Authentification d'un 
 * employé dans la base de données
 * @param  mixed $login
 * @param  mixed $passwrd
 * @return object
 */
function connectUser($login, $passwrd)
{

    $bdd = $GLOBALS['bdd'];

    $req_autent = $bdd->prepare("SELECT * FROM employe WHERE ident = :ident AND mdpass = :mdpass");

    $req_autent->execute(
        [
            "ident" => "$login",
            "mdpass" => "$passwrd",
        ]
    );

    return $req_autent;
}


/**
 * 
 * Retourne le module horaire
 * d'un employé en fonction de son id
 *
 * @param  int $id
 * @return object
 */
function getModuleHoraire($id)
{

    $bdd = $GLOBALS['bdd'];    

    $req_mod_hor = $bdd->query("SELECT TIME_FORMAT(mh.hormod, '%H:%i') AS 'Mod_Hor' FROM  mod_horaire mh, employe e WHERE e.empid = $id AND mh.horid = e.horid");
    
    return $req_mod_hor;
}