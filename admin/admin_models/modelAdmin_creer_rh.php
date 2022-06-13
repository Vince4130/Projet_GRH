<?php


function insertRH($nom, $prenom, $ident, $pwd)
{
    $bdd = $GLOBALS['bdd'];

    $req_insert_rh = $bdd->prepare("INSERT INTO grh.admin VALUES (:adminid, :nom, :prenom, :ident, :mdpass, :estAdmin)");

    $req_insert_rh->execute(
        [
            'adminid'  => NULL,
            'nom'      => "$nom",
            'prenom'   => "$prenom",
            'ident'    => "$ident",
            'mdpass'   => "$pwd",
            'estAdmin' => false,
        ]
    );

    return $req_insert_rh;
}

/**
 * Vérifie l'existence d'un idenfiant pour RH en base
 * @param string $ident
 * 
 * @return [type]
 */
function existIdentRH($ident)
{
    $bdd = $GLOBALS['bdd'];

    $req_exist_ident = $bdd->prepare("SELECT ident FROM grh.admin WHERE ident =:ident");

    $req_exist_ident->execute(['ident' => "$ident"]);

    return $req_exist_ident;
}