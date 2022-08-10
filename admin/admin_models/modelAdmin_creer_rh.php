<?php


/**
 * 
 * Insere un responsable RH en base
 * 
 * @param mixed $nom
 * @param mixed $prenom
 * @param mixed $ident
 * @param mixed $pwd
 * @param mixed $estAdmin
 * 
 * @return [type]
 */
function insertRH($nom, $prenom, $ident, $pwd, $estAdmin)
{
    $bdd = $GLOBALS['bdd'];

    $req_insert_rh = $bdd->prepare("INSERT INTO grh.admin VALUES (:adminid, :nom, :prenom, :ident, :mdpass, :estAdmin)");

    $req_insert_rh->execute(
        [
            'adminid'  => NULL,
            'nom'      => "$nom",
            'prenom'   => "$prenom",
            'ident'    => "$ident",
            'mdpass'   => "$pwd",
            'estAdmin' => $estAdmin,
        ]
    );

    return $req_insert_rh;
}


/**
 * Vérifie l'existence d'un idenfiant pour un RH en base
 * @param string $ident
 * 
 * @return [type]
 */
function existIdentRH($ident)
{
    $bdd = $GLOBALS['bdd'];

    $req_exist_ident = $bdd->prepare("SELECT ident FROM grh.admin WHERE ident =:ident");

    $req_exist_ident->execute(['ident' => "$ident"]);

    return $req_exist_ident;
}