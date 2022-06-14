<?php

function planning()
{
    require('./classes/planning.class.php');

    $id = $_SESSION['id'];

    $req_all_abs = getAbsUser($id);

    $absences = $req_all_abs->fetchAll(PDO::FETCH_ASSOC);

    // var_dump($absences);
    foreach($absences as $absence) {
        $period [] = [$absence['debut'], $absence['fin'], $absence['motif']];
       
    }
    $row = count($period);
    
    echo $row."<br><pre>"; var_dump($period); die;
    
    // $conge = intervalAbsence($period[0][0], $period[0][1]);

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

?>