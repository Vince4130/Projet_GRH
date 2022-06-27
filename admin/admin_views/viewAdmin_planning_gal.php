<?php
session_start();

if (!isset($_SESSION['adminIdent'])) {
    header('Location: index.php?action=accueil');
    exit();
 }

require('./includes/header.php');

?>

<div class="register">
     
    <h5>Planning Général</h5>
    <div class="pageform">
        <ul class="pagination">
            <li class="page-item">
                <a class="page-link" href="index.php?action=planningGeneral&month=<?= $month->prevMonth()->month ?>&year=<?= $month->prevMonth()->year ?>"> << </a>
            </li>

            <li class="page-item"><h5 class="mois"><?= $month->toString(); ?></h5></li>
            <li class="page-item">
                <a class="page-link" href="index.php?action=planningGeneral&month=<?= $month->nextMonth()->month ?>&year=<?= $month->nextMonth()->year ?>"> >> </a>
            </li>
        </ul>
    </div>
    <div class="scroll">
        <table class="calendrier">
            <thead>
                <tr>
                    <th style="width:200px">Employé</th>
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
                <?php foreach($liste_employes as $employe) : ?>
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
                                
                            <?php else : ?>

                                    <td style="background-color: <?= $month->conges($dateJour, $conges) == 'F' ? 'dodgerblue' : ($month->conges($dateJour, $conges) == 'C' ? '#30ad23' : 'white') ?>; 
                                    font-weight: bold; ">
                                        <?= $month->conges($dateJour, $conges) ?>
                                    </td>
                                    
                            <?php endif;
                            
                            endif;
                                            
                    endfor;
                endforeach;
                ?>       
                </tr>
            </tbody>

        </table>
    </div>
</div>

<?php
 require('./includes/footer.php');
?>