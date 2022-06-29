<?php

function getListeEmployes ()
{
    $bdd = $GLOBALS['bdd'];

    $req_list_personnel = $bdd->query("SELECT * FROM employe ORDER BY nom, prenom ASC");

    $liste_employes = $req_list_personnel->fetchAll(PDO::FETCH_ASSOC);

    return $liste_employes;
}

function getEmployesAdministratif ()
{
    $bdd = $GLOBALS['bdd'];

    $req_list_personnel_ad = $bdd->query("SELECT * FROM employe WHERE servid = 1 ORDER BY nom, prenom ASC");

    $liste_employes_ad = $req_list_personnel_ad->fetchAll(PDO::FETCH_ASSOC);

    return $liste_employes_ad;
}


function getEmployesInformatique ()
{
    $bdd = $GLOBALS['bdd'];

    $req_list_personnel_inf = $bdd->query("SELECT * FROM employe WHERE servid = 2 ORDER BY nom, prenom ASC");

    $liste_employes_inf = $req_list_personnel_inf->fetchAll(PDO::FETCH_ASSOC);

    return $liste_employes_inf;
}

function deleteEmploye($empid)
{
    $bdd = $GLOBALS['bdd'];

    $req_delete_employe = $bdd->prepare("DELETE FROM employe WHERE empid =:empid");

    $req_delete_employe->execute(['empid' => $empid]);

    return $req_delete_employe;
}