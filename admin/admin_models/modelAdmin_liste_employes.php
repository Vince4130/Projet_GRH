<?php

function getListeEmployes ()
{
    $bdd = $GLOBALS['bdd'];

    $req_list_personnel = $bdd->query("SELECT * FROM employe ORDER BY nom, prenom ASC");

    $liste_employes = $req_list_personnel->fetchAll(PDO::FETCH_ASSOC);

    return $liste_employes;
}

function deleteEmploye($empid)
{
    $bdd = $GLOBALS['bdd'];

    $req_delete_employe = $bdd->prepare("DELETE FROM employe WHERE empid =:empid");

    $req_delete_employe->execute(['empid' => $empid]);

    return $req_delete_employe;
}