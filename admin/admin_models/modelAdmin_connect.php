<?php

/**
 * Fonction authentification
 * responsable RH
 * @param mixed $login
 * @param mixed $passwrd
 * 
 * @return [type]
 */
function connectAdmin($login, $passwrd)
{
    $bdd = $GLOBALS['bdd'];

    $req_autent = $bdd->prepare("SELECT * FROM admin WHERE ident =:ident AND mdpass =:mdpass");

    $req_autent->execute(
        [
            "ident" => "$login",
            "mdpass" => "$passwrd",
        ]
    );

    return $req_autent;
}


/**
 * Retourne la liste des employés
 * @return [type]
 */
function getEmployes ()
{
    $bdd = $GLOBALS['bdd'];

    $req_list_personnel = $bdd->query("SELECT * FROM employe ORDER BY nom, prenom ASC");

    return $req_list_personnel;
}


// function getEmploye($id)
// {
//     $bdd = $GLOBALS['bdd'];

//     $today = date('Y-m-d');
//     // PERIOD_DIFF(NOW(),dateEmbauche)

//     $req_employe = $bdd->prepare("SELECT empid, nom, prenom, email, ident, horid, PERIOD_DIFF(DATE_FORMAT(NOW(),'%Y%m'), DATE_FORMAT(dateEmbauche, '%Y%m')) AS 'anciennete', s.libelle AS 'service', f.libelle AS 'fonction' FROM employe e, service s, fonction f WHERE empid =:empid AND e.fonctid = f.fonctid AND s.servid = e.servid");
    
//     $req_employe->execute(
//         [
//             'empid' => $id
//         ]
//     );
            
//     return $req_employe;
// }


/**
 * Retourne le nombre total d'employés
 * @return [type]
 */
function countEmployes ()
{
    $bdd = $GLOBALS['bdd'];

    $req_total_employe = $bdd->query("SELECT count(empid) AS 'nbempl' FROM employe");
   
    $nb_employe = $req_total_employe->fetch(PDO::FETCH_ASSOC);

    $total = $nb_employe['nbempl'];

    return $total;
}

/**
 * Retourne le nombre de 
 * demandes en absence en attente
 * @return int
 */
function countDemAbs()
{
    $bdd = $GLOBALS['bdd'];

    $req_dem_abs = $bdd->query("SELECT count(*) AS 'total' FROM demande_absence da WHERE da.etat = 'En attente'");
   
    $nb_dem_abs = $req_dem_abs->fetch(PDO::FETCH_ASSOC);

    $total = $nb_dem_abs['total'];

    return $total;
}


/**
 * Retourne le nombre 
 * de demandes de modifications
 * de pointage en attente
 * @return [type]
 */
function countDemPoint()
{
    $bdd = $GLOBALS['bdd'];

    $req_dem_point = $bdd->query("SELECT count(*) AS 'total' FROM demande_pointage dp WHERE dp.etat = 'En attente'");
   
    $nb_dem_point = $req_dem_point->fetch(PDO::FETCH_ASSOC);

    $total = $nb_dem_point['total'];

    return $total;
}
