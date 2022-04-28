<?php

function connectAdmin($login, $passwrd)
{
    $bdd = connexDBA('grh');

    $req_autent = $bdd->prepare("SELECT * FROM admin WHERE ident = :ident AND mdpass = :mdpass");

    $req_autent->execute(
        [
            "ident" => "$login",
            "mdpass" => "$passwrd",
        ]
    );

    return $req_autent;
}


function getEmployes ()
{
    $bdd = connexDBA('grh');

    $req_list_personnel = $bdd->query("SELECT * FROM employe");

    return $req_list_personnel;
}


function getEmploye($id)
{
    $bdd = connexDBA('grh');

    $today = date('Y-m-d');
    // PERIOD_DIFF(NOW(),dateEmbauche)

    $req_employe = $bdd->prepare("SELECT empid AS 'Numéro employé', nom AS 'Nom', prenom AS 'Prénom', PERIOD_DIFF(DATE_FORMAT(NOW(),'%Y%m'), DATE_FORMAT(dateEmbauche, '%Y%m')) AS 'Ancienneté', s.libelle AS 'Service', f.libelle AS 'Fonction' FROM employe e, service s, fonction f WHERE empid = :empid AND e.fonctid = f.fonctid AND s.servid = e.servid");

    $req_employe->execute(
        [
            'empid' => $id
        ]);
            
    return $req_employe;
}


function countEmployes ()
{
    $bdd = connexDBA('grh');

    $req_total_employe = $bdd->query("SELECT count(empid) AS 'nbempl' FROM employe");
   
    $nb_employe = $req_total_employe->fetch(PDO::FETCH_ASSOC);

    $total = $nb_employe['nbempl'];

    return $total;
}


///Connexion à la base de données////
/**
 * connexDB
 *
 * @param  mixed $base
 * @return void
 */
function connexDBA($base)
{

    include_once './includes/inc_param.php';

    $dsn = "mysql:host=" . HOST . ":" . PORT . ";dbname=" . $base . ";charset=UTF8";

    $user = USER;
    $pass = PWD;

    try {
        $bdd = new PDO($dsn, $user, $pass, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
        return $bdd;
    } catch (PDOException $e) {
        echo "Echec connexion : ", $e->getMessage();
        return false;
        exit();
    }
}
