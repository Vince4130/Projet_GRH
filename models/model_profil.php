<?php

function getProfil($id)
{

    $bdd = $GLOBALS['bdd'];

    $req_profil = $bdd->prepare("SELECT nom, prenom, email, ident, mdpass, horid FROM employe WHERE empid = :empid");

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

//Fonction déjà déclarée dans model_connect
// function getModuleHoraire($id, $horid) {

//     $bdd = $GLOBALS['bdd'];

//     $req_mod_hor = $bdd->query("SELECT hormod FROM  mod_horaire mh, employe e WHERE e.empid = $id AND mh.horid = e.horid");

//     return $req_mod_hor;
// }