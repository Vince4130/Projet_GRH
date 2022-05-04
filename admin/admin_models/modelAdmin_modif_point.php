<?php

function getAllModifPointage()
{
    $bdd = $GLOBALS['bdd'];

    $req_modif_point = $bdd->prepare("SELECT DATE_FORMAT(dp.date,'%d/%m/%Y') AS 'Date demande', e.empid AS 'N° employé', e.nom AS 'Nom employé', 
                          DATE_FORMAT(p.pointdate,'%d/%m/%Y') AS 'Date pointage', TIME_FORMAT(dp.ha, '%H:%i') AS 'Heure arrivée',
                          TIME_FORMAT(dp.pm1, '%H:%i') AS 'Pause méridienne 1', TIME_FORMAT(dp.pm2, '%H:%i') AS 'Pause méridienne 2',
                          TIME_FORMAT(dp.hd, '%H:%i') AS 'Heure départ', dp.dempointid AS 'id' FROM demande_pointage dp, employe e, pointage p 
                          WHERE dp.pointid = p.pointid AND p.empid = e.empid ORDER BY e.nom ASC, p.pointdate DESC");
    

    $req_modif_point->execute();

    return $req_modif_point;
}


function getPointageDem ($id)
{
    $bdd = $GLOBALS['bdd'];
    
    $dempointid = (int)($id);

    $req_get_id = $bdd->prepare("SELECT dp.pointid FROM demande_pointage dp WHERE dp.dempointid =:dempointid");

    $req_get_id->execute(['dempointid' => $dempointid]);

    $pointid =  $req_get_id->fetch(PDO::FETCH_ASSOC);

    $pointid = ((int)($pointid['pointid'])); 

    $req_get_pointage = $bdd->prepare("SELECT DATE_FORMAT(p.pointdate,'%d/%m/%Y') AS 'date', e.empid AS 'N° employé', e.nom AS 'nom', e.prenom AS 'prenom',
                            TIME_FORMAT(p.h_arrivee, '%H:%i') AS 'ha',
                            TIME_FORMAT(p.h_mer1, '%H:%i') AS 'pm1', TIME_FORMAT(p.h_mer2, '%H:%i') AS 'pm2',
                            TIME_FORMAT(p.h_depart, '%H:%i') AS 'hd' FROM employe e, pointage p 
                            WHERE p.pointid =:pointid");
                            
    $req_get_pointage->execute(['pointid' => $pointid]);

    return $req_get_pointage;
}

function getDemande($id) 
{
    $bdd = $GLOBALS['bdd'];
    
    $dempointid = (int)($id);

    $req_get_demande = $bdd->prepare("SELECT TIME_FORMAT(dp.ha, '%H:%i') AS 'Heure arrivée',TIME_FORMAT(dp.pm1, '%H:%i') AS 'Pause méridienne 1',
                            TIME_FORMAT(dp.pm2, '%H:%i') AS 'Pause méridienne 2',
                            TIME_FORMAT(dp.hd, '%H:%i') AS 'Heure départ'FROM demande_pointage dp
                            WHERE dp.dempointid =:dempointid");
                            
    $req_get_demande->execute(['dempointid' => $dempointid]);

    return $req_get_demande;
}

