<?php

function getListeEmployes ()
{
   $bdd = $GLOBALS['bdd'];

    $req_list_personnel = $bdd->query("SELECT * FROM employe ORDER BY nom, prenom ASC");

    $liste_employes = $req_list_personnel->fetchAll(PDO::FETCH_ASSOC);

    return $liste_employes;
}