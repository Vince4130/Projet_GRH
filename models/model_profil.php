<?php

/**
 * Retourne le profil d'un employé à partir de son id
 *
 * @param  int $id
 * @return object
 */
function getProfil($id)
{

    $bdd = $GLOBALS['bdd'];

    $req_profil = $bdd->prepare("SELECT * FROM employe WHERE empid = :empid"); //nom, prenom, email, ident, mdpass, horid

    $req_profil->execute(
        [
            'empid' => $id,
        ]
    );

    return $req_profil;
}


/**
 * Mis à jour du profil d'un employé
 *
 * @param  string $mail
 * @param  string $ident
 * @param  string $pass
 * @param  int $id
 * @return object
 */
function updateProfil($mail, $ident, $pass, $id) //$horaire, 
{

    $bdd = $GLOBALS['bdd'];

    $mail  = $bdd->quote($mail);
    $pass  = $bdd->quote($pass);
    $ident = $bdd->quote($ident);
    // var_dump($mail); echo ' ----- '; var_dump($pass); echo ' ----- '; var_dump($horaire); echo ' ----- '; var_dump($id); die;

    $update = "UPDATE employe SET email = $mail, ident = $ident, mdpass = $pass WHERE empid = $id"; //,horid = $horaire 

    $req_update = $bdd->exec($update);

    // $req_update = $bdd->prepare("UPDATE employe SET email = :email, mdpass = :mdpass, horid = :horid WHERE empid =:empid");

    // $req_update->execute(
    //     [
    //         'email'  => "$mail",
    //         'mdpass' => "$pass",
    //         'horid'  => $horaire,
    //         'empid'  => $id,
    //     ]
    // );

    return $req_update;
}


/**
 * Mise à jour du mail et du mot de passe
 * de l'employé
 *
 * @param  string $mail
 * @param  string $pass
 * @param  int $id
 * @return void
 */
function updateMail($mail, $pass, $id)
{
    $bdd = $GLOBALS['bdd'];

    $mail  = $bdd->quote($mail);
    $pass  = $bdd->quote($pass);

    $update = "UPDATE employe SET email = $mail, mdpass = $pass WHERE empid = $id";

    $req_update = $bdd->exec($update);

    return $req_update;
}


/**
 * Mise à jour de l'identifiant et du mot de passe
 * de l'employé
 *
 * @param  string $ident
 * @param  string $pass
 * @param  int $id
 * @return void
 */
function updateIdent($ident, $pass, $id)
{
    $bdd = $GLOBALS['bdd'];

    $ident  = $bdd->quote($ident);
    $pass  = $bdd->quote($pass);

    $update = "UPDATE employe SET ident = $ident, mdpass = $pass WHERE empid = $id";

    $req_update = $bdd->exec($update);

    return $req_update;
}


/**
 * Mise à jour du mot de passe
 * de l'employé
 *
 * @param  mixed $pass
 * @param  mixed $id
 * @return void
 */
function updatePassword($pass, $id)
{
    $bdd = $GLOBALS['bdd'];

    $pass  = $bdd->quote($pass);

    $update = "UPDATE employe SET mdpass = $pass WHERE empid = $id";

    $req_update = $bdd->exec($update);

    return $req_update;
}


/**
 * Retourne le service 
 * en fonction id
 *
 * @param  int $servid
 * @return object
 */
function getService($servid)
{
    $bdd = $GLOBALS['bdd'];

    $req_service = $bdd->prepare("SELECT * FROM service WHERE servid =:servid");

    $req_service->execute(['servid' => $servid]);

    return $req_service;
}


/**
 * Retourne la fonction
 * par l'id
 *
 * @param  int $fonctid
 * @return object
 */
function getFonction($fonctid)
{
    $bdd = $GLOBALS['bdd'];

    $req_fonction = $bdd->prepare("SELECT * FROM fonction WHERE fonctid =:fonctid");

    $req_fonction->execute(['fonctid' => $fonctid]);

    return $req_fonction;
}


/**
 * Retourne l'anciennete d'un employé
 *
 * @param  int $empid
 * @return object
 */
function getAnciennete($empid)
{
    $bdd = $GLOBALS['bdd'];

    $req_anciennete = $bdd->prepare("SELECT PERIOD_DIFF(DATE_FORMAT(NOW(),'%Y%m'), DATE_FORMAT(dateEmbauche, '%Y%m')) AS 'anciennete' FROM employe WHERE empid =:empid");

    $req_anciennete->execute(['empid' => $empid]);

    return $req_anciennete;
}

//fonction deja declaree dans 
// function existMail($mail)
// {
//     $bdd = $GLOBALS['bdd'];

//     $req_exist_mail = $bdd->prepare("SELECT email FROM employe WHERE email =:email");

//     $req_exist_mail->execute(['email' => "$email"]);

//     return $req_exist_mail;
// }


/**
 * Vérifie l'existence d'un idenfiant en base
 *
 * @param  int $ident
 * @return object
 */
function existIdent($ident)
{
    $bdd = $GLOBALS['bdd'];

    $req_exist_ident = $bdd->prepare("SELECT ident FROM employe WHERE ident =:ident");

    $req_exist_ident->execute(['ident' => "$ident"]);

    return $req_exist_ident;
}

//Fonction déjà déclarée dans model_connect
// function getModuleHoraire($id, $horid) {

//     $bdd = $GLOBALS['bdd'];

//     $req_mod_hor = $bdd->query("SELECT hormod FROM  mod_horaire mh, employe e WHERE e.empid = $id AND mh.horid = e.horid");

//     return $req_mod_hor;
// }