<?php

function searchEmploye($nom, $prenom)
{
    $bdd = $GLOBALS['bdd'];

    if (!empty($nom) AND empty($prenom)) {

        $req_search_empl = $bdd->prepare("SELECT * FROM employe WHERE nom LIKE :nom");

        $req_search_empl->execute(
            [
                'nom' => "%$nom%",
            ]
        );

    }

    if (empty($nom) AND !empty($prenom)) {

        $req_search_empl = $bdd->prepare("SELECT * FROM employe WHERE prenom LIKE :prenom");

        $req_search_empl->execute(
            [
                'prenom' => "$prenom",
            ]
        );

    }

    if (!empty($nom) AND !empty($prenom)) {

        $req_search_empl = $bdd->prepare("SELECT * FROM employe WHERE nom LIKE :nom AND prenom LIKE :prenom");

        $req_search_empl->execute(
            [
                'nom'    => "$nom",
                'prenom' => "$prenom",
            ]
        );

    }
    

    return $req_search_empl;
}