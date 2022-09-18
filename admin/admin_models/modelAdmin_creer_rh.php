<?php


/**
 * 
 * Insere un responsable RH en base
 * 
 * @param string $nom
 * @param string $prenom
 * @param string $ident
 * @param string $pwd
 * @param boolean $estAdmin
 * 
 * @return [type]
 */
function insertRH($nom, $prenom, $ident, $pwd, $estAdmin)
{
    $bdd = $GLOBALS['bdd'];

    $req_insert_rh = $bdd->prepare("INSERT INTO admin VALUES (:adminid, :nom, :prenom, :ident, :mdpass, :estAdmin)");

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
 *
 * @param  string $ident
 * @return void
 */
function existIdentRH($ident)
{
    $bdd = $GLOBALS['bdd'];

    $req_exist_ident = $bdd->prepare("SELECT ident FROM admin WHERE ident =:ident");

    $req_exist_ident->execute(['ident' => "$ident"]);

    return $req_exist_ident;
}