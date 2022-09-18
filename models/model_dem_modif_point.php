<?php

/**
 * Retourne un pointage formaté
 * en fonction id du pointage
 *
 * @param  int $id
 * @return void
 */
function getPointage($id) 
{

    $bdd = $GLOBALS['bdd'];
    
    $req_pointage = $bdd->query("SELECT DATE_FORMAT(p.pointdate,'%d/%m/%Y') AS 'Date', TIME_FORMAT(p.h_arrivee,'%H:%i') AS 'ha', TIME_FORMAT(p.h_depart,'%H:%i') AS 'hd',
                                TIME_FORMAT(p.h_mer1, '%H:%i') AS 'pm1', 
                                TIME_FORMAT(p.h_mer2, '%H:%i') AS 'pm2'
                                FROM pointage p, employe e
                                WHERE p.pointid = $id");

    return  $req_pointage;
}


/**
 * Enregistrement d'une demande de 
 * modification de pointage
 *
 * @param  string $date
 * @param  string $ha
 * @param  string $pm1
 * @param  string $pm2
 * @param  string $hd
 * @param  int $point_id
 * @return void
 */
function demandeModifPointage($date, $ha, $pm1, $pm2, $hd, $point_id)
{
   
    $bdd = $GLOBALS['bdd'];
    
    $point_id = (int)($point_id);

    // $empid = getEmployePointage($point_id);
    
    $req_modif_pointage = $bdd->prepare("INSERT INTO demande_pointage VALUES (:dempointid, :datedem, :ha, :pm1, :pm2, :hd, :etat, :pointid)");
    
    $req_modif_pointage->execute(
        [
            'dempointid'     => NULL,
            'datedem'        => "$date",
            'ha'             => "$ha",
            'pm1'            => "$pm1",
            'pm2'            => "$pm2",
            'hd'             => "$hd",
            'etat'           => "En attente",
            'pointid'        => $point_id,
        ]
    );
    
    return $req_modif_pointage;
     
}

/**
 * Vérification existence 
 * d'une demande de mofification de pointage
 * en fonction id du pointage
 *
 * @param  int $point_id
 * @return void
 */
function existModifPointage($point_id)
{
    
    $bdd = $GLOBALS['bdd'];

    $req_exist_modif = $bdd->prepare("SELECT pointid, etat FROM demande_pointage WHERE pointid =:pointid"); // AND etat =:etat

    $req_exist_modif->execute(
        [
            'pointid' => $point_id,
            // 'etat'    => "En attente",
        ]);

    return $req_exist_modif;    
}