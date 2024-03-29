<?php
@session_start();

if (!isset($_SESSION['ident'])) {
  header('Location: index.php?action=accueil');
  exit();
}

require ('./includes/header.php');

?>

<div class="register">
     
    <h5>Historique des pointages</h5>
    <table class="tableau">
        <thead style="border-bottom-color: black">
            <tr>
                <th>Date</th>
                <th>Heure Arrivée</th>
                <th>Heure Départ</th>
                <th>Temps théorique</th>
                <th>Temps réalisé</th>
                <th>Pause&nbsp;<span>*</span></th>
                <th>Solde journée</th>
                <th>Cumul</th>
                <th>Modification</th>
            </tr>
        </thead>
                    
        <tbody>
            <?php if (isset($tab)) {           
                for ($i=$mapage->firstLine(); $i <= $mapage->lastLine(); $i++) {                
                    echo "<tr>";                    
                   foreach($tab[$i] as $key => $val) {
                        if($key == 8) { 
                           if($val == 'En attente') { ?>
                            <td><span class="attente">En attente</span> </td>
                            
                       <?php } else if ($val == "Acceptée") { ?>
                            <td><span class="acceptee">Acceptée</span> </td>
                        <?php } else if($val == "Refusée") { ?>        
                            <td><span class="refusee">Refusée</span> </td>
                        <?php } else { ?>
                            <td><button class="btn btn-edit" title="Modifier" onclick="location.href='index.php?action=demModifPoint&point_id=<?= $val ?>'"><i class="fa fa-edit"></i></button></td>
                        <?php } 
                        }
                        else { ?>
                           <td style="color: <?php if(($key == 6 OR $key == 7) && substr($val, 0, 1) == '-') echo "red" ?>"><?= $val ?></td>
                       <?php }                      
                    }                 
                    echo "</tr>";
                }
            }
            else  {
                echo "<tr><td colspan='9' style=\"color: white; background-color: dodgerblue; height: 40px;\">Aucun pointage à ce jour</td></tr>";
            }
            $req_histo_point->closeCursor();
            ?>
        </tbody>

    </table>
    <div class="pageform">
        
        <ul class="pagination">

            <!-- Lien vers la page précédente (désactivé si on se trouve sur la 1ère page) -->
            <li class="page-item <?= ($mapage->getPage() == 1) ? "disabled" : "" ?>">
                <a href="index.php?action=histo_point&page=<?= $mapage->previousPage()->getPage() ?>" class="page-link"><<</a>
            </li>
                    
            <?php for ($i = 1; $i <= $mapage->getNbPages(); $i++) : ?>
                
                <!-- Lien vers chacune des pages (activé si on se trouve sur la page correspondante) -->
                <li class="page-item <?= ($mapage->getPage() == $i) ? "active" : "" ?>">
                    <a href="index.php?action=histo_point&page=<?= $i ?>" class="page-link"><?= $i ?></a>
                </li>

            <?php endfor; ?>

            <!-- Lien vers la page suivante (désactivé si on se trouve sur la dernière page) -->
            <li class="page-item <?= ($mapage->getPage() == $mapage->getNbPages()) ? "disabled" : "" ?> ">
                <a href="index.php?action=histo_point&page=<?= $mapage->nextPage()->getPage() ?>" class="page-link">>></a>    
            </li>
        </ul>                        
    </div>
    <h6 class="champs"><span>*&nbsp;</span>Pause minimum décomptée 45mn</h6>
</div>

<?php
 require('./includes/footer.php');
?>