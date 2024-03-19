<?php
@session_start();

if (!isset($_SESSION['ident'])) {
  header('Location: index.php?action=accueil');
  exit();
}

require('./includes/header.php');

?>

<table class="legend">
    <!-- <caption>Légende</caption> -->
    <thead>
        <!-- <tr>
            <th colspan=4 >Légende</th>
        </tr> -->
        <tr>
            <th>Week-End</th>
            <th>Jour Férié</th>
            <th>Congés</th>
            <th>Formation</th>
            <th>Télétravail</th>
            <th>Temps Partiel</th>
            <th>Total</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>-</td>
            <td>-</td>
            <td>C</td>
            <td>F</td>
            <td>T</td>
            <td>P</td>
            <td>C/F/T</td>
        </tr>
        <tr>
            <td>-</td>
            <td><?= $nbJoursAbs[3] ?></td>
            <td><?= $nbJoursAbs[0] ?></td>
            <td><?= $nbJoursAbs[1] ?></td>
            <td><?= $nbJoursAbs[2] ?></td>
            <td><?= $nbJoursAbs[4] ?></td>
            <td><?= $nbJoursAbs[0]+$nbJoursAbs[1]+$nbJoursAbs[2] ?></td>
        </tr>
    </tbody>        
</table>

<div class="register">
     
    <h5>Planning</h5>
    <div class="pageform">
    <ul class="pagination">
        <li class="page-item">
            <a class="page-link" href="index.php?action=planning&month=<?= $month->prevMonth()->month ?>&year=<?= $month->prevMonth()->year ?>"> << </a>
        </li>

        <li class="page-item"><h5 class="mois"><?= $month->toString(); ?></h5></li>
        <li class="page-item">
            <a class="page-link" href="index.php?action=planning&month=<?= $month->nextMonth()->month ?>&year=<?= $month->nextMonth()->year ?>"> >> </a>
        </li>
    </ul>
</div>
    <table class="calendrier_empl">
        <thead>
            <tr>
            <?php for($i=1; $i <= $nbjourmois; $i++) : 
                    $numJour = date('N', strtotime("$month->year-$month->month-$i"));
                    $jour = $month->dayFrench($numJour);
                    $dateJour = date('Y-m-d', strtotime("$month->year-$month->month-$i"));
                ?>         
                    <th style="background-color: <?= $month->isToday($dateJour) ? '#17f26f' : 'white'; ?>; color: <?php if($month->isToday($dateJour)) echo 'black'; ?>">
                        <?= $i ?></br>
                        <?= $jour ?>
                    </th>         
                <?php endfor; ?>
            </tr>
        </thead>
        
        <tbody>
            <tr>
            <?php for($i=1; $i <= $nbjourmois; $i++) : 
                    
                    $numJour = date('N', strtotime("$month->year-$month->month-$i"));
                    $jour = $month->dayFrench($numJour);
                    $dateJour = date('Y-m-d', strtotime("$month->year-$month->month-$i"));
                    
                    if ($month->jourFerie($dateJour)) : ?>
                        
                        <td style="background-color: red">-</td>
                    
                    <?php else : 
                            
                            if ($month->weekEnd($dateJour)) : ?>       
                            <!-- $jour == "Dim" OR $jour == "Sam"     -->
                            <td style="background-color: lightgrey">-</td>
                        
                     <?php else :

                            if(!isset($conges)) {
                                echo "<td></td>"; 
                            }
                            else { ?>
                                <td style="background-color: <?= $month->conges($dateJour, $conges) == 'F' ? 'dodgerblue' : ($month->conges($dateJour, $conges) == 'C' ? '#30ad23' : ($month->conges($dateJour, $conges) == 'T' ? '#ff1bbe' : ($month->conges($dateJour, $conges) == 'P' ? '#8080ff' : 'white'))) ?>; 
                                font-weight: bold; ">
                                    <?= $month->conges($dateJour, $conges) ?>
                                </td>
                            <?php } ?>    
                    <?php endif;
                    
                    endif;
                                     
            endfor;
            ?>       
            </tr>
        </tbody>
    </table>
</div>

<?php
 require('./includes/footer.php');
?>