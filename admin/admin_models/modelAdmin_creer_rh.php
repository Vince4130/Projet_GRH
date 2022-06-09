<?php


function insertRH($nom, $prenom, $ident, $pwd)
{
    $bdd = $GLOBALS['bdd'];

    $req_insert_rh = $bdd->prepare("INSERT INTO admin VALUES (:adminid, :nom, :ident, :mdpass, :estAdmin");

    $req_insert_rh->execute(
        [
            'adminid'  => NULL,
            'nom'      => $nom,
            'ident'    => $ident,
            'mdpass'   => $pwd,
            'estAdmin' => 1,
        ]
    );

    return $req_insert_rh;
}