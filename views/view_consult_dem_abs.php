<?php
session_start();

if (!isset($_SESSION['ident'])) {
  header('Location: index.php?action=accueil');
  exit();
}

require ('./includes/header.php');

?>

<script>
    
</script>

<div class="register">
    <div class="bandeau"> 
        <?php if (isset($_POST ['submit'])) {
            if ($erreur) { ?>
            <div class="echec" id="echec">
                <?= $text_erreur; ?>
                <button type="button" class="croix" onclick="cacheDiv('echec')">x</button>
            </div>
        <?php } else { ?>
            <div class="succes" id="succes"><?= $text_erreur ?></div>
            <script>
                setTimeout('window.location = "index.php?action=consultDemAbs"', 1000);
            </script>

        <?php }
            }  
        ?>
    </div>
     
    <h5>Vos demandes d'absences</h5>
        <table class="tableau">
            <thead>
                <tr> 
                    <th>Date demande</th>
                    <th>Motif</th>
                    <th>Date début</th>
                    <th>Date fin</th>
                    <th>Nb de jours&nbsp;<span>*</span></th>
                    <th>Statut</th>
                    <th>Supprimer</th>
                </tr>
            </thead>

            <tbody>
                <?php if($dem_abs) :
                    for ($i=$mapage->firstLine(); $i <= $mapage->lastLine(); $i++) : ?>   
                        <tr>
                            <td><?= formatDate(inverseDAte($dem_abs[$i]['date_dem'])) ?></td>
                            <td><?= $dem_abs[$i]['libelle'] ?></td>
                            <td><?= formatDate(inverseDAte($dem_abs[$i]['date_deb'])) ?></td>
                            <td><?= formatDate(inverseDAte($dem_abs[$i]['date_fin'])) ?></td>
                            <td><?= $dem_abs[$i]['nb_j'] ?></td>
                            <td><span class="<?= ($dem_abs[$i]['etat'] == 'En attente') ? 'attente' : (($dem_abs[$i]['etat'] == 'Acceptée' ? 'acceptee' : 'refusee')) ?>" ><?= $dem_abs[$i]['etat'] ?></span></td>
                            <form action="index.php?action=consultDemAbs" method="post">
                                <input type="text" hidden name="abs_id" value="<?= $dem_abs[$i]['demabsid'] ?>" />
                                <td><button type="submit" name="submit" class="btn btn-edit"><i class="fa fa-trash"></i></button></td> 
                            </form>
                            <!-- <button class="btn btn-edit" onclick="location.href='index.php?action=consultDemAbs&abs_id=<?= $dem['demabsid'] ?>'"><i class="fa fa-edit"></i></button></td>              -->
                        </tr>
                    <?php
                    endfor;
                    
                else : ?>
                    <tr><td colspan='7' style="color: white; background-color: dodgerblue; height: 40px;">Aucune demande à ce jour</td></tr>
                <?php
                endif;
                ?>
            </tbody>
        </table>

        <div class="pageform">
            
            <ul class="pagination">

                <!-- Lien vers la page précédente (désactivé si on se trouve sur la 1ère page) -->
                <li class="page-item <?= ($mapage->getPage() == 1) ? "disabled" : "" ?>">
                    <a href="index.php?action=consultDemAbs&page=<?= $mapage->previousPage()->getPage() ?>" class="page-link"><<</a>
                </li>
                        
                <?php for ($i = 1; $i <= $mapage->getNbPages(); $i++) : ?>
                    
                    <!-- Lien vers chacune des pages (activé si on se trouve sur la page correspondante) -->
                    <li class="page-item <?= ($mapage->getPage() == $i) ? "active" : "" ?>">
                        <a href="index.php?action=consultDemAbs&page=<?= $mapage->getPage() ?>" class="page-link"><?= $i ?></a>
                    </li>

                <?php endfor; ?>

                <!-- Lien vers la page suivante (désactivé si on se trouve sur la dernière page) -->
                <li class="page-item ">
                    <a href="index.php?action=consultDemAbs&page=<?= $mapage->nextPage()->getPage() ?>" class="page-link">>></a>    
                </li>
            </ul>                        
        </div>
    
    <h6 class="champs"><span>*</span>&nbsp;Les jours fériés et les jours de week end ne sont pas décomptés</h6>
    
</div>

<?php
 require('./includes/footer.php');
?>