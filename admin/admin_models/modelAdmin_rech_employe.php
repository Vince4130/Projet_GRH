<?php

function searchEmploye($nom, $prenom)
{
    $bdd = $GLOBALS['bdd'];

    $req_search_empl = $bdd->prepare("SELECT * FROM employe WHERE nom =:nom AND prenom LIKE :prenom");

    $req_search_empl->execute(
        [
            'nom'    => $nom,
            'prenom' => $prenom,
        ]
    );

    return $req_search_empl;
}