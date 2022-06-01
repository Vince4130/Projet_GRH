<?php

/**
 * Insertion d'un nouvel agent dans la base
 * La date d'embauche correspond à la date du jour
 * @param mixed $nom
 * @param mixed $prenom
 * @param mixed $mail
 * @param mixed $ident
 * @param mixed $passwd
 * @param mixed $jour
 * @param mixed $horaire
 * @param mixed $service
 * @param mixed $fonction
 * 
 * @return [type]
 */
function userRegistration($nom, $prenom, $mail, $ident, $passwd, $jour, $horaire, $service, $fonction)
{
    
    $bdd = $GLOBALS['bdd'];

    $jour = date('Y-m-d');

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
        ]
    );

    return $req_registration;
}


/**
 * Retourne la liste des fonctions
 * @return [type]
 */
function getListFonctions()
{
    $bdd = $GLOBALS['bdd'];

    $req_liste_fonctions = "SELECT * FROM fonction";

    $liste_fonctions = $bdd->query($req_liste_fonctions);

    $fonctions = $liste_fonctions->fetchAll(PDO::FETCH_ASSOC);

    return $fonctions;
}


/**
 * Vérification de l'existence d'un mail ou d'un identifinat dans la base
 * @param mixed $mail
 * @param mixed $ident
 * 
 * @return [type]
 */
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
