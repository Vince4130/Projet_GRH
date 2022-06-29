<?php

function planningInformatique()
{
    require('./classes/planning.class.php');

    $liste_employes_inf = getEmployesInformatique();
    
    try {
        $month = new Month($_GET['month'] ?? null, $_GET['year'] ?? null);
    }
    catch (Exception $e) {
        $month = new Month();
    }

    $moisencours  = $month->month;

    $anneeencours = $month->year;

    $nbjourmois = cal_days_in_month(CAL_GREGORIAN, $moisencours, $anneeencours);

    require ('./admin/admin_views/viewAdmin_planning_inf.php');
}