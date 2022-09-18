<?php

/**
 * Retourne la liste des 
 * employés service informatique
 *
 * @return void
 */
function getEmployesInformatique ()
{
    $bdd = $GLOBALS['bdd'];

    $req_list_personnel_info = $bdd->query("SELECT * FROM employe WHERE servid = 2 ORDER BY nom, prenom ASC");

    $liste_employes_info = $req_list_personnel_info->fetchAll(PDO::FETCH_ASSOC);

    return $liste_employes_info;
}