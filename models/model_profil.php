<?php

include_once('../includes/inc_param.php');

require_once('../includes/inc_functions.php');


function getProfil($id) {

    $bdd = connexDB('grh');

    $req_profil = $bdd->prepare("SELECT nom, prenom, email, ident, mdpass, horid FROM employe WHERE empid = :empid");

    $req_profil->execute(
        [
            'empid' => $id
        ]
    );

    return $req_profil;
}

function updateProfil($mail, $pass, $horaire, $id) {

    $bdd = connexDB('grh');

    $mail = $bdd->quote($mail);
    $pass = $bdd->quote($pass);

    // var_dump($mail); echo ' ----- '; var_dump($pass); echo ' ----- '; var_dump($horaire); echo ' ----- '; var_dump($id); die;

    $update = "UPDATE employe SET email = $mail, mdpass = $pass, horid = $horaire WHERE empid = $id";
    
    $req_update = $bdd->exec($update);

    return $req_update;
}

function getModuleHoraire($id, $horid) {

    $bdd = connexDB('grh');

    $req_mod_hor = $bdd->query("SELECT hormod FROM  mod_horaire mh, employe e WHERE e.empid = $id AND mh.horid = e.horid");

    return $req_mod_hor;
}

?>