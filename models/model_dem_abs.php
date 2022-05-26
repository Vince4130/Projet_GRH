<?php

function demandeAbs($empid, $typeid, $jour, $debut, $fin, $year, $nbJourAbs)
{
    $bdd = $GLOBALS['bdd'];

    $req_insert_dem_abs = $bdd->prepare("INSERT INTO demande_absence VALUES (:demabsid, :empid, :typeid, :date_dem, :date_deb, :date_fin, :annee, :nb_j, :etat)");

    $req_insert_dem_abs->execute(
        [
            'demabsid' => NULL,
            'empid'    => $empid,
            'typeid'   => $typeid,
            'date_dem' => "$jour",
            'date_deb' => "$debut",
            'date_fin' => "$fin",
            'annee'    => "$year", 
            'nb_j'     => $nbJourAbs,
            'etat'     => "En attente",
        ]
    );

    return $req_insert_dem_abs;
}