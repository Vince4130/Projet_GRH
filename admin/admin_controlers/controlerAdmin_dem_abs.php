<?php
session_start();

require ('./admin/admin_models/modelAdmin_dem_abs.php');

function validAbs()
{
    $req_dem_abs = getAllDemAbs();
    $tab = $req_dem_abs->fetchAll(PDO::FETCH_ASSOC);
    // echo "<pre>"; var_dump($tab);
    require ('./admin/admin_views/viewAdmin_dem_abs.php');
}