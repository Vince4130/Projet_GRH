<?php

/**
 * Retourne la liste
 * des employés administratifs
 *
 * @return void
 */
function getEmployesAdministratif ()
{
    $bdd = $GLOBALS['bdd'];

    $req_list_personnel_ad = $bdd->query("SELECT * FROM employe WHERE servid = 1 ORDER BY nom, prenom ASC");

    $liste_employes_ad = $req_list_personnel_ad->fetchAll(PDO::FETCH_ASSOC);

    return $liste_employes_ad;
}


/**
 * Retourne la fonction d'un employé
 * à partir de son id
 *
 * @param  mixed $empid
 * @return void
 */
function getFonctionById($empid)
{
  
    $bdd = $GLOBALS['bdd'];

    $req_fonction = $bdd->prepare("SELECT libelle FROM fonction f, employe e WHERE f.fonctid = e.fonctid AND e.empid = :empid");

    $req_fonction->execute(['empid' => $empid]);

    $libelle = $req_fonction->fetch(PDO::FETCH_ASSOC);
    
    return $libelle['libelle'];
}


/**
 * Retourne le service d'un employé
 * à partir de son id
 *
 * @param  mixed $empid
 * @return void
 */
function getServiceById($empid)
{
  
    $bdd = $GLOBALS['bdd'];

    $req_service = $bdd->prepare("SELECT libelle FROM service s, employe e WHERE s.servid = e.servid AND e.empid = :empid");

    $req_service->execute(['empid' => $empid]);

    $libelle = $req_service->fetch(PDO::FETCH_ASSOC);
    
    return $libelle['libelle'];
}