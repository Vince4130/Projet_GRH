<?php
session_start();

if (!isset($_SESSION['adminIdent'])) {
    header('Location: index.php?action=accueil');
    exit();
}
  
require ('./includes/header.php');

?>

<div class="register">
    <div class="bandeau">
        <?php if (isset($_POST['submit'])) {
            if ($erreur) {?>
                <div class="echec" id="echec"><?= $text_erreur ?>
                    <button type="button" class="croix" onclick="cacheDiv('echec')">x</button>
                </div>
        <?php } else {?>
                <div class="succes" id="succes"><?= $text_erreur ?></div>
                    <script>
                        setTimeout('window.location = "index.php?action=validAbs"', 3000);
                    </script>
        <?php }
        }
        ?>
    </div>
     
    <h5>Demandes d'absences en attente</h5>
        <table class="tableau">
            <thead style="border-bottom-color: black">
                <tr>
                    <th>Date demande</th>
                    <th>N° Employé</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Motif</th>
                    <th>Date début</th>
                    <th>Date fin</th>
                    <th>Validation</th>
                    <th>Annulation</th>
                </tr>     
            </thead>

            <tbody>
        
            <?php  
                if($tab_all_dem)  :
                    for ($i = $mapage->firstLine(); $i <= $mapage->lastLine(); $i++) : ?>         
                        <tr>
                            <td><?= formatDate(inverseDate($tab_all_dem[$i]['date_dem'])) ?></td>
                            <td><?= $tab_all_dem[$i]['empid'] ?></td>
                            <td><?= $tab_all_dem[$i]['nom'] ?></td>
                            <td><?= $tab_all_dem[$i]['prenom'] ?></td>
                            <td><?= $tab_all_dem[$i]['libelle'] ?></td>
                            <td><?= formatDate(inverseDate($tab_all_dem[$i]['date_deb'])) ?></td>
                            <td><?= formatDate(inverseDate($tab_all_dem[$i]['date_fin'])) ?></td>

                            <form action="index.php?action=validAbs" method="post">
                                <td style="display: none;"><input type="text" hidden name="demabsid" value="<?= $tab_all_dem[$i]['demabsid'] ?>" /></td>
                                <td><input type="submit" class="btn btn-success validabs" name="submit" value="Valider" /></td>
                                <td><input type="submit" class="btn btn-danger validabs" name="submit"  value="Refuser" /></td>
                            </form>
                        </tr>
                        <?php 
                    endfor; 
                else :  ?>
                    <tr><td colspan='10' style="color: white; background-color: dodgerblue; height: 40px;">Aucune demande d'absence en attente</td></tr>
                <?php 
                endif; 
            ?>          
        </table>
        
        <div class="pageform">           
            <ul class="pagination">
                
                <!-- Lien vers la page précédente (désactivé si on se trouve sur la 1ère page) -->
                <li class="page-item <?= ($mapage->getPage() == 1) ? "disabled" : "" ?>">
                    <a href="index.php?action=validAbs&page=<?= $mapage->previousPage()->getPage() ?>" class="page-link"><<</a>
                </li>
                        
                <?php for ($i = 1; $i <= $mapage->getNbPages(); $i++) : ?>
                    
                    <!-- Lien vers chacune des pages (activé si on se trouve sur la page correspondante) -->
                    <li class="page-item <?= ($mapage->getPage() == $i) ? "active" : "" ?>">
                        <a href="index.php?action=validAbs&page=<?= $mapage->getPage() ?>" class="page-link"><?= $i ?></a>
                    </li>

                <?php endfor; ?>

                <!-- Lien vers la page suivante (désactivé si on se trouve sur la dernière page) -->
                <li class="page-item ">
                    <a href="index.php?action=validAbs&page=<?= $mapage->nextPage()->getPage() ?>" class="page-link">>></a>    
                </li>
            </ul>                        
        </div>
                      
</div>

<?php 
 require('./includes/footer.php');
?>