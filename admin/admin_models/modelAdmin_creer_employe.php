<?php

// function getLibelleService($servid)
// {
//     $bdd = $GLOBALS['bdd'];

//     $req_lib_service = $bdd->prepare("SELECT libelle FROM service WHERE servid = :servid");

//     $req_lib_service->execute(['servid' => $servid]);

//     $service =  $req_lib_service->fetchAll(PDO::FETCH_ASSOC);

//     return $service['libelle'];
// }


// function getLibelleFonction($id)
// {
//     $bdd = $GLOBALS['bdd'];

//     $req_lib_fonction = $bdd->prepare("SELECT libelle FROM fonction WHERE fonctid = :fonctid");

//     $req_lib_fonction->execute(['fonctid' => $id]);
  
//     $fonction =  $req_lib_fonction->fetch(PDO::FETCH_ASSOC);
   
//     return $fonction['libelle'];
// }

/**
 * Retourne les fonctions
 * d'un service par l'id du service
 *
 * @param  int $servid
 * @return void
 */
function getFonctionsService($servid)
{
    $bdd = $GLOBALS['bdd'];
    
    $req_lib_fonct_serv = $bdd->prepare("SELECT * FROM fonction WHERE servid = :servid AND servid IN (SELECT servid FROM service) ORDER BY libelle");

    $req_lib_fonct_serv->execute(['servid' => $servid]);

    $fonctions = $req_lib_fonct_serv->fetchAll(PDO::FETCH_ASSOC);
   
    return $fonctions;

}

/**
 * Retourne la liste
 * des modules horaires
 *
 * @return void
 */
function getHoraires()
{
    $bdd = $GLOBALS['bdd'];

    $req_horaires = $bdd->query("SELECT horid, TIME_FORMAT(hormod, '%H:%i') AS 'horaire' FROM mod_horaire ORDER BY horaire DESC");

    $horaires = $req_horaires->fetchAll(PDO::FETCH_ASSOC);

    return $horaires;
}