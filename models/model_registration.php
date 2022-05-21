<?php

function userRegistration($nom, $prenom, $mail, $ident, $passwd, $jour, $horaire, $service, $fonction)
{
    
    $bdd = $GLOBALS['bdd'];

    $req_registration = $bdd->prepare("INSERT INTO employe VALUES (:empid, :nom, :prenom, :email, :ident, :mdpass, :dateEmbauche, :horid, :servid, :fonctid)");

    $req_registration->execute(
        [
            'empid'        => null,
            'nom'          => "$nom",
            'prenom'       => "$prenom",
            'email'        => "$mail",
            'ident'        => "$ident",
            'mdpass'       => "$passwd",
            'dateEmbauche' => $jour,
            'horid'        => $horaire,
            'servid'       => $service,
            'fonctid'      => $fonction,
        ]);

    return $req_registration;
}


function getListFonctions()
{
    $bdd = $GLOBALS['bdd'];

    $req_liste_fonctions = "SELECT * FROM fonction";

    $liste_fonctions = $bdd->query($req_liste_fonctions);

    $fonctions = $liste_fonctions->fetchAll(PDO::FETCH_ASSOC);

    return $fonctions;
}


function userMailIdent($mail, $ident)
{

    $bdd = $GLOBALS['bdd'];

    $req_exist = $bdd->prepare("SELECT email, ident FROM employe WHERE email = :email OR ident = :ident");

    $req_exist->execute(
        [
            'email' => "$mail",
            'ident' => "$ident",
        ]
    );

    return $req_exist;
}
