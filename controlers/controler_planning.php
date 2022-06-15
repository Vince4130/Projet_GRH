<?php

function planning()
{
    require('./classes/planning.class.php');

    $id = $_SESSION['id'];

    $req_all_abs = getAbsUser($id);

    $absences = $req_all_abs->fetchAll(PDO::FETCH_ASSOC);

    for($i=0 ; $i < count($absences); $i++) {
        $conges [] = ['periode' => intervalAbsence($absences[$i]['debut'], $absences[$i]['fin']), 'motif' => $absences[$i]['motif']]; 
    }
    
    
    $dateJour = "2022-05-31";
    foreach($conges as $conge) {
        for($j = 0; $j <= count($conge['periode']); $j++) {
            if($conge['periode'][$j] == $dateJour) {
                echo $conge['motif'];
            }
        }
    }
  $couleur = ($conge['motif'] == "Congés") ? "limegreen" : "#8080ff";
    
        
   
    // var_dump(count($conge['periode']));
    // echo "<pre>"; var_dump($absences);
   
    // foreach($absences as $absence) {
    //     $period [] = $absence;    
    // }
   
    
//    foreach($conges as $conge) {
//     echo "<pre>"; var_dump($conge);
//     var_dump(count($conge['periode']));
//    }

//    var_dump(count($conge['periode']));
   
// echo "<pre>"; var_dump($conges);
    

    try {
        $month = new Month($_GET['month'] ?? null, $_GET['year'] ?? null);
    }
    catch (Exception $e) {
        $month = new Month();
    }

    $moisencours  = $month->month;

    $anneeencours = $month->year;

    $nbjourmois = cal_days_in_month(CAL_GREGORIAN, $moisencours, $anneeencours);

    require('./views/view_planning.php');
}