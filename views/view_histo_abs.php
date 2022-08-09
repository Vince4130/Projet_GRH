<?php
@session_start();

if (!isset($_SESSION['ident'])) {
  header('Location: index.php?action=accueil');
  exit();
}

require ('./includes/header.php');

?>

<script>
    
</script>

<div class="register">

    <div class="bandeau"></div>
     
    <h5>Historique d'absences</h5>

    <table class="tableau">
        <thead>
            <tr> 
                <th>Date début</th>
                <th>Date fin</th>
                <th>Motif</th>
                <th>Nb de jours&nbsp;<span>*</span></th>
            </tr>
        </thead>

        <tbody>
            <?php if($absences) :
                for ($i=$mapage->firstLine(); $i <= $mapage->lastLine(); $i++) : ?>   
                    <tr>
                        <td><?= formatDate(inverseDAte($absences[$i]['debut'])) ?></td>
                        <td><?= formatDate(inverseDAte($absences[$i]['fin'])) ?></td>
                        <td><span class="<?= $absences[$i]['motif'] ?>"><?= $absences[$i]['motif'] ?></span></td>
                        <td><?= $jours[$i] ?></td>
                    </tr>
                <?php
                endfor;
            else : ?>
                <tr><td colspan='4' style="color: white; background-color: dodgerblue; height: 40px;">Aucune absence à ce jour</td></tr>
            <?php
            endif;
            ?>
        </tbody>
    </table>
   
    <div class="pageform">
        
        <ul class="pagination">

            <!-- Lien vers la page précédente (désactivé si on se trouve sur la 1ère page) -->
            <li class="page-item <?= ($mapage->getPage() == 1) ? "disabled" : "" ?>">
                <a href="index.php?action=histoAbsences&page=<?= $mapage->previousPage()->getPage() ?>" class="page-link"><<</a>
            </li>
                    
            <?php for ($i = 1; $i <= $mapage->getNbPages(); $i++) : ?>
                
                <!-- Lien vers chacune des pages (activé si on se trouve sur la page correspondante) -->
                <li class="page-item <?= ($mapage->getPage() == $i) ? "active" : "" ?>">
                    <a href="index.php?action=histoAbsences&page=<?= $i ?>" class="page-link"><?= $i ?></a>
                </li>

            <?php endfor; ?>

            <!-- Lien vers la page suivante (désactivé si on se trouve sur la dernière page) -->
            <li class="page-item ">
                <a href="index.php?action=histoAbsences&page=<?= $mapage->nextPage()->getPage() ?>" class="page-link">>></a>    
            </li>
        </ul>                        
    </div>
    
    <h6 class="champs"><span>*</span>&nbsp;Les jours fériés et les jours de week end ne sont pas décomptés</h6>
    
</div>

<?php
 require('./includes/footer.php');
?>