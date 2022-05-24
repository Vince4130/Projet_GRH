<?php

function getEmploye($id)
{
    $bdd = $GLOBALS['bdd'];

    $today = date('Y-m-d');
    // PERIOD_DIFF(NOW(),dateEmbauche)

    $req_employe = $bdd->prepare("SELECT empid, nom, prenom, email, ident, horid, PERIOD_DIFF(DATE_FORMAT(NOW(),'%Y%m'), DATE_FORMAT(dateEmbauche, '%Y%m')) AS 'anciennete', s.libelle AS 'service', f.libelle AS 'fonction' FROM employe e, service s, fonction f WHERE empid =:empid AND e.fonctid = f.fonctid AND s.servid = e.servid");
    
    $req_employe->execute(
        [
            'empid' => $id
        ]
    );
            
    return $req_employe;
}