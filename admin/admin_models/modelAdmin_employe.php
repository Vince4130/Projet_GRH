<?php

/**
 * Retourne le profil d'un employé
 * @param int $id
 * 
 * @return [type]
 */
function getEmploye($id)
{
    $bdd = $GLOBALS['bdd'];

    $today = date('Y-m-d');
    // PERIOD_DIFF(NOW(),dateEmbauche)

    $req_employe = $bdd->prepare("SELECT empid, nom, prenom, email, ident, horid, f.fonctid AS 'fonctid', s.servid AS 'servid', PERIOD_DIFF(DATE_FORMAT(NOW(),'%Y%m'), DATE_FORMAT(dateEmbauche, '%Y%m')) AS 'anciennete', s.libelle AS 'service', f.libelle AS 'fonction' FROM employe e, service s, fonction f WHERE empid =:empid AND e.fonctid = f.fonctid AND s.servid = e.servid");
    
    $req_employe->execute(
        [
            'empid' => $id
        ]
    );
            
    return $req_employe;
}


/**
 * Retourne le solde de jours d'abscences en fonction du type d'absence
 * @param int $empid
 * @param int $type
 * 
 * @return [type]
 */
function getSoldeAbsences($empid, $type)
{
    $bdd = $GLOBALS['bdd'];

    $req_absences = $bdd->prepare("SELECT nb_jours AS 'jours', annee, libelle FROM type_conge tc, droits_conges dc, employe e WHERE dc.typeid = tc.id AND e.empid=dc.empid AND e.empid =:empid AND tc.id =:id");

    $req_absences->execute(
        [
            'empid' => $empid,
            'id'    => $type,
        ]
    );

    $solde = $req_absences->fetch(PDO::FETCH_ASSOC);

    return $solde;
}


/**
 * Retourne la liste des services
 * @return [type]
 */
function getListServices()
{
    $bdd = $GLOBALS['bdd'];

    $req_liste_services = "SELECT * FROM service";

    $liste_services = $bdd->query($req_liste_services);

    $services = $liste_services->fetchAll(PDO::FETCH_ASSOC);

    return $services;
}

/**
 * Mise à jour du profil d'un employé
 * @param mixed $servid
 * @param mixed $fonctid
 * @param mixed $horid
 * @param mixed $id_employe
 * 
 * @return [type]
 */
function updateEmploye($servid, $fonctid, $horid, $id_employe)
{
    $bdd= $GLOBALS['bdd'];

    // $update = "UPDATE employe SET horid = $horid, servid = $servid, fonctid = $fonctid WHERE empid = $id_employe";

    // $req_update_empl = $bdd->exec($update);
    
    $req_update_empl = $bdd->prepare("UPDATE employe SET horid =:horid, servid =:servid, fonctid =:fonctid WHERE empid =:empid");

    $req_update_empl->execute(
        [
            'horid'   => $horid,
            'servid'  => $servid,
            'fonctid' => $fonctid,
            'empid'   => $id_employe,
        ]
    );

    return $req_update_empl;
}