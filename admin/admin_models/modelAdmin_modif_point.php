<?php

function getAllModifPointage()
{
    $bdd = $GLOBALS['bdd'];

    $req_modif_point = $bdd->prepare("SELECT DATE_FORMAT(dp.date,'%d/%m/%Y') AS 'Date demande', e.empid AS 'N° employé', e.nom AS 'Nom', e.prenom AS 'prenom',
                          DATE_FORMAT(p.pointdate,'%d/%m/%Y') AS 'Date pointage', dp.dempointid AS 'id' FROM demande_pointage dp, employe e, pointage p 
                          WHERE dp.pointid = p.pointid AND p.empid = e.empid AND dp.etat = 'En attente' ORDER BY e.nom ASC, p.pointdate DESC");
                // , TIME_FORMAT(dp.ha, '%H:%i') AS 'Heure arrivée',
                // TIME_FORMAT(dp.pm1, '%H:%i') AS 'Pause méridienne 1', TIME_FORMAT(dp.pm2, '%H:%i') AS 'Pause méridienne 2',
                // TIME_FORMAT(dp.hd, '%H:%i') AS 'Heure départ', 

    $req_modif_point->execute();

    return $req_modif_point;
}

//Récupération du pointage correspondant à la demande de modification
function getPointageDem ($id)
{
    $bdd = $GLOBALS['bdd'];
    
    $dempointid = (int)($id);

    //Récupération de l'id du pointage correspondant à la demande de modification de ce pointage
    $req_get_id = $bdd->prepare("SELECT dp.pointid FROM demande_pointage dp WHERE dp.dempointid =:dempointid");

    $req_get_id->execute(['dempointid' => $dempointid]);

    $pointid =  $req_get_id->fetch(PDO::FETCH_ASSOC);

    $pointid = ((int)($pointid['pointid'])); 

    //Récupération du pointage
    $req_get_pointage = $bdd->prepare("SELECT DATE_FORMAT(p.pointdate,'%d/%m/%Y') AS 'date', e.empid , e.nom, e.prenom,
                            TIME_FORMAT(p.h_arrivee, '%H:%i') AS 'ha',
                            TIME_FORMAT(p.h_mer1, '%H:%i') AS 'pm1', TIME_FORMAT(p.h_mer2, '%H:%i') AS 'pm2',
                            TIME_FORMAT(p.h_depart, '%H:%i') AS 'hd', p.pointid AS 'id'
                            FROM employe e, pointage p 
                            WHERE p.pointid =:pointid");
                            
    $req_get_pointage->execute(['pointid' => $pointid]);

    return $req_get_pointage;
}


function getDemande($id) 
{
    $bdd = $GLOBALS['bdd'];
    
    $dempointid = (int)($id);

    $req_get_demande = $bdd->prepare("SELECT TIME_FORMAT(dp.ha, '%H:%i') AS 'ha',TIME_FORMAT(dp.pm1, '%H:%i') AS 'pm1',
                            TIME_FORMAT(dp.pm2, '%H:%i') AS 'pm2',
                            TIME_FORMAT(dp.hd, '%H:%i') AS 'hd', dp.dempointid AS 'id'
                            FROM demande_pointage dp
                            WHERE dp.dempointid =:dempointid");
                            
    $req_get_demande->execute(['dempointid' => $dempointid]);

    return $req_get_demande;
}


function updatePointage($pointid, $ha, $pm1, $pm2, $hd) 
{
    $bdd = $GLOBALS['bdd'];
    
    $req_update_pointage = $bdd->prepare("UPDATE pointage SET h_arrivee =:ha, h_mer1 =:pm1, h_mer2 =:pm2, h_depart =:hd WHERE pointid =:id");

    $req_update_pointage->execute(
        [
            'id'  => $pointid,
            'ha'  => $ha,
            'pm1' => $pm1,
            'pm2' => $pm2,
            'hd'  => $hd,
        ]
    );

    // if($req_update_pointage) {
    //     var_dump($req_update_pointage); die;
    // } else {
    //     echo "je comprends rien"; die;
    // }
    
    return $req_update_pointage;
}


function updateDemande($demid, $decision, $pointid)
{
    $bdd = $GLOBALS['bdd'];
    // var_dump($demid); echo " ------ "; var_dump($decision); die;
    $req_update_demande = $bdd->prepare("UPDATE demande_pointage SET etat =:etat WHERE dempointid = $demid AND pointid = $pointid");

    $req_update_demande->execute(
        [
            'etat' => "$decision",
        ]
    );

    return $req_update_demande;
}

