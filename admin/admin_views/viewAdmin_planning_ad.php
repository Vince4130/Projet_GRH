<?php
@session_start();

if (!isset($_SESSION['adminIdent'])) {
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
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>-</td>
            <td>-</td>
            <td>C</td>
            <td>F</td>
            <td>T</td>
        </tr>
    </tbody>        
</table>

<div class="register">
     
    <h5>Planning Service Administratif</h5>
    <div class="pageform">
        <ul class="pagination">
            <li class="page-item">
                <a class="page-link" href="index.php?action=planningAdministratif&month=<?= $month->prevMonth()->month ?>&year=<?= $month->prevMonth()->year ?>"> << </a>
            </li>

            <li class="page-item"><h5 class="mois"><?= $month->toString(); ?></h5></li>
            <li class="page-item">
                <a class="page-link" href="index.php?action=planningAdministratif&month=<?= $month->nextMonth()->month ?>&year=<?= $month->nextMonth()->year ?>"> >> </a>
            </li>
        </ul>
    </div>

    <table class="calendrier" style="width: <?= ($nbjourmois == 31) ? '1455px' : ($nbjourmois == 28 ? '1335px' : ($nbjourmois == 29 ? '1375px' : '1415px')) ?>">
        <thead>
            <tr>
                <th>Employé</th>

                <?php for($i=1; $i <= $nbjourmois; $i++) : 
                    $numJour = date('N', strtotime("$month->year-$month->month-$i"));
                    $jour = $month->dayFrench($numJour);
                ?>         
                    <th>
                        <?= $i ?></br>
                        <?= $jour ?>
                    </th>         
                <?php endfor; ?>
            </tr>
        </thead>
        
        <tbody>

        <?php if(empty($liste_employes_ad)) :
           echo "<td>Aucun employé</td>";
           for($i=1; $i <= $nbjourmois; $i++) :
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
                                echo "<td></td>";
                                   endif;
                           endif;
           endfor;
         else : ?>

                <?php foreach($liste_employes_ad as $employe) : ?>
                
                <tr>
                
                    <td><?= $employe['prenom']. " " . $employe['nom'] ?></td>
                
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
                            
                                    $conges =  getCongesEmploye($employe);
                                            
                                    if(!isset($conges)) {
                                        echo "<td></td>"; 
                                    }
                                    else {
                            ?>

                                    <td style="background-color: <?= $month->conges($dateJour, $conges) == 'F' ? 'dodgerblue' : ($month->conges($dateJour, $conges) == 'C' ? '#30ad23' : 'white') ?>; 
                                    font-weight: bold; ">
                                        <?= $month->conges($dateJour, $conges) ?>
                                    </td>
                                <?php } ?>

                            <?php endif;
                            
                            endif;
                                            
                    endfor;
                endforeach;
        endif; ?>       
            </tr>
        </tbody>

    </table>
    
</div>

<?php
 require('./includes/footer.php');
?>