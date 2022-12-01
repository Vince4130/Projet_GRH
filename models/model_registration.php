<?php

/**
 * Insertion d'un nouvel agent dans la base
 * La date d'embauche correspond à la date du jour
 * Trigger qui ajoute droits congés pour l'année en cours
 * pour tous les types de congés à l'enregistrement d'un employé
 *
 * @param  string $nom
 * @param  string $prenom
 * @param  string $mail
 * @param  string $ident
 * @param  string $passwd
 * @param  string $jour
 * @param  int $horaire
 * @param  int $service
 * @param  int $fonction
 * @return void
 */
function userRegistration($nom, $prenom, $mail, $ident, $passwd, $jour, $horaire, $service, $fonction)
{
    
    $bdd = $GLOBALS['bdd'];

    // $jour = date('Y-m-d');

    $req_registration = $bdd->prepare("INSERT INTO employe VALUES (:empid, :nom, :prenom, :email, :ident, :mdpass, :dateEmbauche, :horid, :servid, :fonctid)");

    $req_registration->execute(
        [
            'empid'        => NULL,
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
 *
 * @return void
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
 *
 * @param  string $mail
 * @param  string $ident
 * @return void
 */
function userMailIdent($mail, $ident)
{

    $bdd = $GLOBALS['bdd'];
    // var_dump($ident); die;

    $req_exist = $bdd->prepare("SELECT email, ident FROM employe WHERE email =:email OR ident =:ident");

    $req_exist->execute(
        [
            'email' => $mail,
            'ident' => $ident,
        ]
    );

    return $req_exist;
}


/**
 * Retourne le nombre
 * d'employés
 *
 * @return int $nb
 */
function getNbEmploye()
{
    $bdd = $GLOBALS['bdd'];

    $nb = $bdd->query("SELECT count(*) AS 'empid' FROM employe");

    return $nb->rowCount();
}


/**
 * getLastId
 * Retourne l'id du dernier employé inséré
 *
 * @return int $last_empid
 */
function getLastId()
{
    $bdd = $GLOBALS['bdd'];

    $last_empid = $bdd->query("SELECT MAX(empid) AS 'last_id' FROM employe");

    return $last_empid->fetch(PDO::FETCH_ASSOC);
}

/**
 * insertCreditAnterieur
 * Insertion du crédit antérieur de l'employé
 * lors de son enregistrement
 *
 * @param  int $empid
 * @param  time $temps
 * @return void
 */
function insertCreditAnterieur($empid, $temps)
{
    $bdd = $GLOBALS['bdd'];
    
    $req_insert_cred = $bdd->prepare("INSERT INTO credit_ant VALUES (:id, :temps, :empid)");
   
    $req_insert_cred->execute(
        [
            'id'    => NULL,
            'temps' => $temps,
            'empid' => $empid,
        ]
    );

    return $req_insert_cred;
}