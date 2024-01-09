<?php

include_once('./includes/inc_param.php');

/**
 * 
 * Retourne le crédit/débit horaire
 * d'un employé en fonction de son id
 *
 * @param  int $id
 * @return object
 */
function getCredit($id)
{

    $bdd = $GLOBALS['bdd'];

    $req_credit = $bdd->query("SELECT TIME_FORMAT(p.h_arrivee, '%H:%i') AS 'Heure Arrivée', TIME_FORMAT(p.h_depart, '%H:%i') AS 'Heure Départ',
                                TIME_FORMAT(TIMEDIFF(p.h_mer2, p.h_mer1), '%H:%i') AS 'Pause méridienne', TIME_FORMAT(mh.hormod, '%H:%i') AS 'Module horaire',
                                TIME_FORMAT(TIMEDIFF(TIMEDIFF(p.h_depart, p.h_arrivee), TIMEDIFF(p.h_mer2, p.h_mer1)), '%H:%i') AS 'Temps réalisé'
                                FROM pointage p, employe e, mod_horaire mh
                                WHERE p.empid = e.empid AND e.horid = mh.horid AND e.empid = $id ORDER BY p.pointdate");

    return $req_credit;
}


/**
 * Retourne les absences d'un employé par son id
 * sur l'année en cours
 * @param int $id
 * 
 * @return array
 */
function getAbsences($id)
{
    $bdd = $GLOBALS['bdd'];

    $year = date('Y');

    $req_absences = $bdd->prepare("SELECT tc.id AS 'typeid', tc.libelle AS 'libelle', dc.nb_jours AS 'nbjours' FROM type_conge tc, droits_conges dc, employe e WHERE dc.empid = e.empid AND dc.typeid = tc.id AND e.empid =:empid AND dc.annee =:annee");

    $req_absences->execute(
        [
            'empid' => $id,
            'annee' => $year,
        ]
    );

    $tab_absences = $req_absences->fetchAll(PDO::FETCH_ASSOC);

    return $tab_absences;
}


/**
 * Retourne la dernière année des droits à congés
 * enregistrée pour un employé en fonction de son id
 * 
 * @param  mixed $id
 * @return int
 */
function getLastYearDroits($id) : int
{
    $bdd = $GLOBALS['bdd'];

    $req_last_year = $bdd->prepare("SELECT MAX(dc.annee) FROM droits_conges dc, employe e WHERE dc.empid = e .empid AND dc.empid =:empid");

    $req_last_year->execute(
        [
            'empid' => $id,
        ]
    );

    $last_year = $req_last_year->fetch(PDO::FETCH_NUM);

    return $last_year[0];
}


function getTypeConges() : array
{
    $bdd = $GLOBALS['bdd'];

    $req_type_conges = $bdd->query("SELECT id FROM type_conge");
    // echo '<pre>'; var_dump($req_type_conges->fetchAll(PDO::FETCH_ASSOC)); die;
    return $req_type_conges->fetchAll(PDO::FETCH_ASSOC);
}

/**
 * Mise à jour des droits conges annuels d'un employe
 * lors d'un changement d'annee
 *
 * @param  mixed $id
 * @param  mixed $year
 * @return void
 */
function updateDroitsAnnuels($id, $year)
{
    $bdd = $GLOBALS['bdd'];

    $type_conges = getTypeConges();

    $soldeConges = getCongesLastYear($id);
    $solde = $soldeConges['solde'];
    
    if($solde <= 5) {
        $solde = $solde;
    } else {
        $solde = 5;
    }
    
    foreach($type_conges as $type) {
        if($type['id'] == 1) {
            updateConges(45 + $solde, $year, $id, 1);
        } elseif($type['id'] == 2) {
            updateConges(15, $year, $id, 2);
        } elseif($type['id'] == 3) {
            updateConges(100, $year, $id, 3);
        }
    }   
}


/**
 * Mise a jour des droits d'un employe selon le type de conges
 * pour une annee 
 *
 * @param  mixed $id
 * @param  mixed $year
 * @param  mixed $nbjours
 * @param  mixed $typeid
 * @return void
 */
function updateConges($nbjours, $year, $id, $typeid)
{
    $bdd = $GLOBALS['bdd'];

    $req_update_conges = $bdd->prepare("INSERT INTO droits_conges VALUES (:droitsid, :nb_jours, :annee, :empid, :typeid)");

    $req_update_conges->execute(
        [
            'droitsid' => NULL,
            'nb_jours' => $nbjours,
            'annee'    => $year,
            'empid'    => $id,
            'typeid'   => $typeid,
        ]

    );
}


function getCongesLastYear($id)
{
    $bdd = $GLOBALS['bdd'];

    $last_year = (int)date('Y') - 1;

    $req_conges_last_year = $bdd->prepare("SELECT dc.nb_jours AS 'solde' FROM droits_conges dc, employe e  WHERE dc.empid = e.empid AND dc.empid =:empid AND dc.typeid =:typeid AND dc.annee =:annee");

    $req_conges_last_year->execute(
        [
            'annee' => $last_year,
            'empid' => $id,
            'typeid' => 1,
        ]
    );

    $soldeConges = $req_conges_last_year->fetch(PDO::FETCH_ASSOC);
   
    return $soldeConges;
}