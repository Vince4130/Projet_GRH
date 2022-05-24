<?php

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


function getEmployes ()
{
   $bdd = $GLOBALS['bdd'];

    $req_list_personnel = $bdd->query("SELECT * FROM employe");

    return $req_list_personnel;
}


function getEmploye($id)
{
    $bdd = $GLOBALS['bdd'];

    $today = date('Y-m-d');
    // PERIOD_DIFF(NOW(),dateEmbauche)

    $req_employe = $bdd->prepare("SELECT empid AS 'Numéro employé', nom AS 'Nom', prenom AS 'Prénom', PERIOD_DIFF(DATE_FORMAT(NOW(),'%Y%m'), DATE_FORMAT(dateEmbauche, '%Y%m')) AS 'Ancienneté', s.libelle AS 'Service', f.libelle AS 'Fonction' FROM employe e, service s, fonction f WHERE empid =:empid AND e.fonctid = f.fonctid AND s.servid = e.servid");

    $req_employe->execute(
        [
            'empid' => $id
        ]
    );
            
    return $req_employe;
}


function countEmployes ()
{
   $bdd = $GLOBALS['bdd'];

    $req_total_employe = $bdd->query("SELECT count(empid) AS 'nbempl' FROM employe");
   
    $nb_employe = $req_total_employe->fetch(PDO::FETCH_ASSOC);

    $total = $nb_employe['nbempl'];

    return $total;
}
