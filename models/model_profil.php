<?php

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


function updateProfil($mail, $pass, $id) //$horaire, 
{

    $bdd = $GLOBALS['bdd'];

    $mail = $bdd->quote($mail);
    $pass = $bdd->quote($pass);

    // var_dump($mail); echo ' ----- '; var_dump($pass); echo ' ----- '; var_dump($horaire); echo ' ----- '; var_dump($id); die;

    $update = "UPDATE employe SET email = $mail, mdpass = $pass WHERE empid = $id"; //,horid = $horaire 

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


function getService($servid)
{
    $bdd = $GLOBALS['bdd'];

    $req_service = $bdd->prepare("SELECT * FROM service WHERE servid =:servid");

    $req_service->execute(['servid' => $servid]);

    return $req_service;
}


function getFonction($fonctid)
{
    $bdd = $GLOBALS['bdd'];

    $req_fonction = $bdd->prepare("SELECT * FROM fonction WHERE fonctid =:fonctid");

    $req_fonction->execute(['fonctid' => $fonctid]);

    return $req_fonction;
}


function getAnciennete($empid)
{
    $bdd = $GLOBALS['bdd'];

    $req_anciennete = $bdd->prepare("SELECT PERIOD_DIFF(DATE_FORMAT(NOW(),'%Y%m'), DATE_FORMAT(dateEmbauche, '%Y%m')) AS 'anciennete' FROM employe WHERE empid =:empid");

    $req_anciennete->execute(['empid' => $empid]);

    return $req_anciennete;
}


//Fonction déjà déclarée dans model_connect
// function getModuleHoraire($id, $horid) {

//     $bdd = $GLOBALS['bdd'];

//     $req_mod_hor = $bdd->query("SELECT hormod FROM  mod_horaire mh, employe e WHERE e.empid = $id AND mh.horid = e.horid");

//     return $req_mod_hor;
// }