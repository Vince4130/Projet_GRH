<?php

/**
 * Insertion d'une demande d'absence
 * Statut par défaut "En attente" avant validation RH
 *
 * @param  int $empid
 * @param  int $typeid
 * @param  string $jour
 * @param  string $debut
 * @param  string $fin
 * @param  strint $year
 * @param  int $nbJourAbs
 * @return void
 */
function demandeAbs($empid, $typeid, $jour, $debut, $fin, $year, $nbJourAbs)
{
    $bdd = $GLOBALS['bdd'];

    $req_insert_dem_abs = $bdd->prepare("INSERT INTO demande_absence VALUES (:demabsid, :date_dem, :date_deb, :date_fin, :annee, :nb_j, :etat, :empid, :typeid)");

    $req_insert_dem_abs->execute(
        [
            'demabsid' => NULL,
            'date_dem' => "$jour",
            'date_deb' => "$debut",
            'date_fin' => "$fin",
            'annee'    => "$year", 
            'nb_j'     => $nbJourAbs,
            'etat'     => "En attente",
            'empid'    => $empid,
            'typeid'   => $typeid,
        ]
    );

    return $req_insert_dem_abs;
}


/**
 * Vérification existence d'une demande d'absence sur la période demandée
 *
 * @param  string $debut
 * @param  string $fin
 * @param  int $empid
 * @return void
 */
function existDemande($debut, $fin, $empid) {

    $bdd =$GLOBALS['bdd'];
    
    $req_whithin_dem = $bdd->prepare("SELECT * FROM demande_absence da WHERE da.empid =:empid AND ((:date_deb BETWEEN da.date_deb AND da.date_fin) OR (:date_fin BETWEEN da.date_deb AND da.date_fin))");

    $req_whithin_dem->execute(
        [
            'empid'    => $empid,
            'date_deb' => "$debut",
            'date_fin' => "$fin",
        ]
    );

    return $req_whithin_dem;
}


/**
 *Vérification existence d'une absence sur la période demandée
 * @param string $debut
 * @param string $fin
 * @param int $empid
 * @return void
 */
function existAbsence($debut, $fin, $empid) {

    $bdd =$GLOBALS['bdd'];

    $req_whithin_abs = $bdd->prepare("SELECT * FROM conges c WHERE c.empid =:empid AND ((c.date_deb BETWEEN :date_deb AND :date_fin) OR (c.date_fin BETWEEN :date_deb AND :date_fin))");

    $req_whithin_abs->execute(
        [
            'empid'    => $empid,
            'date_deb' => $debut,
            'date_fin' => $fin,
        ]
    );

    return $req_whithin_abs;
}


/**
 * Retourne le libellé du
 * type d'absence en fonction id
 *
 * @param  int $id
 * @return void
 */
function getTypeAbs($id)
{
    $bdd = $GLOBALS['bdd'];

    $libelle = $bdd->prepare("SELECT libelle FROM type_conge WHERE id =:id");

    $libelle->execute(['id' => $id]);

    return $libelle;
    
}


/**
 * Retourne l'ensemble 
 * des motifs d'absences
 *
 * @return void
 */
function getMotifs() 
{
    $bdd = $GLOBALS['bdd'];

    $motifs = $bdd->query("SELECT * FROM type_conge");

    return $motifs;
}