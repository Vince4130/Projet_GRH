<?php

// function connectUser($login, $passwrd)
// {

//     $bdd = $GLOBALS['bdd'];

//     $req_autent = $bdd->prepare("SELECT * FROM employe WHERE ident = :ident AND mdpass = :mdpass");

//     $req_autent->execute(
//         [
//             "ident" => "$login",
//             "mdpass" => "$passwrd",
//         ]
//     );

//     return $req_autent;
// }


// function getModuleHoraire($id)
// {

//     $bdd = $GLOBALS['bdd'];    

//     $req_mod_hor = $bdd->query("SELECT TIME_FORMAT(mh.hormod, '%H:%i') AS 'Mod_Hor' FROM  mod_horaire mh, employe e WHERE e.empid = $id AND mh.horid = e.horid");
    
//     return $req_mod_hor;
// }


// function histoPointage($id)
// {

//     $bdd = $GLOBALS['bdd'];

//     $req_histo = $bdd->query("SELECT DATE_FORMAT(p.pointdate,'%d/%m/%Y') AS 'Date', TIME_FORMAT(p.h_arrivee, '%H:%i') AS 'Heure Arrivée', TIME_FORMAT(p.h_depart, '%H:%i') AS 'Heure Départ',
//                                 TIME_FORMAT(TIMEDIFF(p.h_mer2, p.h_mer1), '%H:%i') AS 'Pause méridienne', TIME_FORMAT(mh.hormod, '%H:%i') AS 'Module horaire',
//                                 TIME_FORMAT(TIMEDIFF(TIMEDIFF(p.h_depart, p.h_arrivee), TIMEDIFF(p.h_mer2, p.h_mer1)), '%H:%i') AS 'Temps réalisé', p.pointid AS 'point_id'
//                                 FROM pointage p, employe e, mod_horaire mh
//                                 WHERE p.empid = e.empid AND e.horid = mh.horid AND e.empid = $id ORDER BY p.pointdate");

//     return $req_histo;
// }


function lignesPointage($id) 
{
    
    $bdd = $GLOBALS['bdd'];

    $req_lignes = $bdd->query("SELECT count(pointid) AS 'nbLignes' FROM pointage WHERE empid = $id");

    $rowNumbers = $req_lignes->fetch(PDO::FETCH_ASSOC);

    return $rowNumbers['nbLignes'];
}


function getProfil($id)
{

    $bdd = $GLOBALS['bdd'];

    $req_profil = $bdd->prepare("SELECT nom, prenom, email, ident, mdpass, horid FROM employe WHERE empid = :empid");

    $req_profil->execute(
        [
            'empid' => $id,
        ]
    );

    return $req_profil;
}


function updateProfil($mail, $pass, $id) //$horaire, 
{

    $bdd = $GLOBALS['bdd'];

    $mail = $bdd->quote($mail);
    $pass = $bdd->quote($pass);

    // var_dump($mail); echo ' ----- '; var_dump($pass); echo ' ----- '; var_dump($horaire); echo ' ----- '; var_dump($id); die;

    $update = "UPDATE employe SET email = $mail, mdpass = $pass WHERE empid = $id"; //,horid = $horaire 

    $req_update = $bdd->exec($update);

    // $req_update = $bdd->prepare("UPDATE employe SET email = :email, mdpass = :mdpass, horid = :horid WHERE empid =:empid");

    // $req_update->execute(
    //     [
    //         'email'  => "$mail",
    //         'mdpass' => "$pass",
    //         'horid'  => $horaire,
    //         'empid'  => $id,
    //     ]
    // );

    return $req_update;
}


// function getCredit($id)
// {

//     $bdd = $GLOBALS['bdd'];

//     $req_credit = $bdd->query("SELECT TIME_FORMAT(p.h_arrivee, '%H:%i') AS 'Heure Arrivée', TIME_FORMAT(p.h_depart, '%H:%i') AS 'Heure Départ',
//                                 TIME_FORMAT(TIMEDIFF(p.h_mer2, p.h_mer1), '%H:%i') AS 'Pause méridienne', TIME_FORMAT(mh.hormod, '%H:%i') AS 'Module horaire',
//                                 TIME_FORMAT(TIMEDIFF(TIMEDIFF(p.h_depart, p.h_arrivee), TIMEDIFF(p.h_mer2, p.h_mer1)), '%H:%i') AS 'Temps réalisé'
//                                 FROM pointage p, employe e, mod_horaire mh
//                                 WHERE p.empid = e.empid AND e.horid = mh.horid AND e.empid = $id ORDER BY p.pointdate");

//     return $req_credit;
// }


// function userRegistration($nom, $prenom, $mail, $ident, $passwd, $jour, $horaire, $service, $fonction)
// {
    
//     $bdd = $GLOBALS['bdd'];

//     $req_registration = $bdd->prepare("INSERT INTO employe VALUES (:empid, :nom, :prenom, :email, :ident, :mdpass, :dateEmbauche, :horid, :servid, :fonctid)");

//     $req_registration->execute(
//         [
//             'empid'        => null,
//             'nom'          => "$nom",
//             'prenom'       => "$prenom",
//             'email'        => "$mail",
//             'ident'        => "$ident",
//             'mdpass'       => "$passwd",
//             'dateEmbauche' => $jour,
//             'horid'        => $horaire,
//             'servid'       => $service,
//             'fonctid'      => $fonction,
//         ]);

//     return $req_registration;
// }

// function getListFonctions()
// {
//     $bdd = $GLOBALS['bdd'];

//     $req_liste_fonctions = "SELECT * FROM fonction";

//     $liste_fonctions = $bdd->query($req_liste_fonctions);

//     $fonctions = $liste_fonctions->fetchAll(PDO::FETCH_ASSOC);

//     return $fonctions;
// }


// function userMailIdent($mail, $ident)
// {

//     $bdd = $GLOBALS['bdd'];

//     $req_exist = $bdd->prepare("SELECT email, ident FROM employe WHERE email = :email OR ident = :ident");

//     $req_exist->execute(
//         [
//             'email' => "$mail",
//             'ident' => "$ident",
//         ]
//     );

//     return $req_exist;
// }


function insertPointage($jour, $ha, $p1, $p2, $hd, $id) 
{
    
    $bdd = $GLOBALS['bdd'];

    $req_insert_pointage = $bdd->prepare("INSERT INTO pointage VALUES (:id, :pointdate, :ha, :hm1, :hm2, :hd, :empid)");

    $req_insert_pointage->execute(
        [
            'id'        => NULL,
            'pointdate' => "$jour",
            'ha'        => "$ha",
            'hm1'       => "$p1",
            'hm2'       => "$p2",
            'hd'        => "$hd",
            'empid'     => $id,     
        ]);
    
    return $req_insert_pointage;
}


function existPointage ($jour, $id)
{

    $bdd = $GLOBALS['bdd'];

    $req_deja_pointe = "SELECT * FROM pointage p, employe e WHERE e.empid = p.empid AND e.empid = $id AND p.pointdate = '$jour'";

    $result = $bdd->query($req_deja_pointe);

    $dejapointe = $result->rowCount();

    return $dejapointe;
}


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



// function getEmployePointage($point_id) déjà commmentée avant passage controler pour chaque fichier


// function getEmployePointage($point_id)
// {   

//     //$bdd = connexDB('grh');
//     //Récupération de l'id de l'employé 
//     $req_id_employe = $bdd->prepare("SELECT p.empid FROM pointage p, employe e WHERE p.pointid = :pointid AND e.empid = p.empid");
    
//     $req_id_employe->execute(['pointid' => $point_id]);
    
//     $id_employe = $req_id_employe->fetch(PDO::FETCH_ASSOC);

//     $empid = (int)($id_employe['empid']);

//     return $empid;
// }

function demandeModifPointage($date, $ha, $pm1, $pm2, $hd, $point_id)
{
   
    $bdd = $GLOBALS['bdd'];
    
    $point_id = (int)($point_id);

    // $empid = getEmployePointage($point_id);
    
    $req_modif_pointage = $bdd->prepare("INSERT INTO demande_pointage VALUES (:dempointid, :pointid, :datedem, :ha, :pm1, :pm2, :hd, :etat)");
    
    $req_modif_pointage->execute(
        [
            'dempointid'     => NULL,
            'pointid'        => $point_id,
            'datedem'        => "$date",
            'ha'             => "$ha",
            'pm1'            => "$pm1",
            'pm2'            => "$pm2",
            'hd'             => "$hd",
            'etat'           => "En attente",
        ]);
    
    return $req_modif_pointage;
     
}

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


// ///Connexion à la base de données////
// /**
//  * connexDB
//  *
//  * @param  mixed $base
//  * @return void
//  */
// function connexDB($base)
// {

//     include_once('./includes/inc_param.php');

//     $dsn = "mysql:host=" . HOST . ":" . PORT . ";dbname=" . $base . ";charset=UTF8";

//     $user = USER;
//     $pass = PWD;

//     try {
//         $bdd = new PDO($dsn, $user, $pass, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
//         return $bdd;
//     } catch (PDOException $e) {
//         echo "Echec connexion : ", $e->getMessage();
//         return false;
//         exit();
//     }
// }

