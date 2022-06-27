<?php

function planningGeneral()
{
    require('./classes/planning.class.php');

    $liste_employes = getEmployes();
    
   
    // $req_all_abs = getAbsUser($id);

    // $absences = $req_all_abs->fetchAll(PDO::FETCH_ASSOC);

    // for($i=0 ; $i < count($absences); $i++) {
    //     $conges [] = ['periode' => intervalAbsence($absences[$i]['debut'], $absences[$i]['fin']), 'motif' => $absences[$i]['motif']]; 
    // }
    
    // $couleur = ($conge['motif'] == "Congés") ? "limegreen" : "#8080ff";
    
    try {
        $month = new Month($_GET['month'] ?? null, $_GET['year'] ?? null);
    }
    catch (Exception $e) {
        $month = new Month();
    }

    $moisencours  = $month->month;

    $anneeencours = $month->year;

    $nbjourmois = cal_days_in_month(CAL_GREGORIAN, $moisencours, $anneeencours);

    require ('./admin/admin_views/viewAdmin_planning_gal.php');
}