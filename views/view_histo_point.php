<?php

session_start();

if (!isset($_SESSION['ident'])) {
    redirection('index.php?action=accueil');
}

require('./includes/header_2.php');

?>

 <div class="register">
    <h5>Historique des pointages</h5><i class="bi bi-cart4"></i>

    <table class="tableau">
        <thead style="border-bottom-color: black">
            <tr>
                <th>Date</th>
                <th>Heure Arrivée</th>
                <th>Heure de Départ</th>
                <th>Temps théorique</th>
                <th>Temps réalisé</th>
                <th>Solde</th>
                <th>Cumul</th>
            </tr>
        </thead>

        <tbody>
            <?php if (isset($tab)) {           
                for ($i=$firstLine; $i <= $lastLine; $i++) {                
                    echo "<tr>";                    
                   foreach($tab[$i] as $key => $val) {
                        echo "<td>$val</td>";
                    }
                }                 
                    echo "</tr>";
            }
            else  {
                echo "<tr><td colspan='8' style=\"color: white; background-color: dodgerblue; height: 40px;\">Aucun pointage à ce jour</td></tr>";
            }
            $req_histo_point->closeCursor();
            ?>
        </tbody>

    </table>

    <div class="pageform">
        <ul class="pagination">

            <!-- Lien vers la page précédente (désactivé si on se trouve sur la 1ère page) -->
            <li class="page-item <?= ($pageActuelle == 1) ? "disabled" : "" ?>">
                <a href="index.php?action=histo_point&page=<?= $pageActuelle - 1 ?>" class="page-link"><<</a>
            </li>
                    
            <?php for ($i = 1; $i <= $nbPages; $i++) : ?>
            
            <!-- Lien vers chacune des pages (activé si on se trouve sur la page correspondante) -->
            <li class="page-item <?= ($pageActuelle == $i) ? "active" : "" ?>"" >
                <a href="index.php?action=histo_point&page=<?= $i ?>" class="page-link"><?= $i ?></a>
            </li>
            <?php endfor; ?>
            
            <!-- Lien vers la page suivante (désactivé si on se trouve sur la dernière page) -->
            <li class="page-item <?= ($pageActuelle == $nbPages) ? "disabled" : "" ?>">
                <a href="index.php?action=histo_point&page=<?= $pageActuelle + 1 ?>" class="page-link">>></a>
            </li>

        </ul>        
    </div>
                        
</div>

<?php
 require('./includes/footer.php');
?>