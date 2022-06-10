<?php
session_start();

if (!isset($_SESSION['adminIdent'])) {
   header('Location: index.php?action=accueil');
   exit();
}

include('./includes/header.php');

?>
<!-- <Script>
    function lanceModal(ligne) {
        var id = document.getElementsByTagName('table')[0].getElementsByTagName('tr')[ligne].getElementsByTagName('td')[0].innerHTML;
        $('button').click(function(){
        $('#supp').modal('show');
        });
    }  
</Script> -->

<div class="register">
    <div class="bandeau">
        <?php if (isset($_POST ['submit'])) {
            if ($erreur) { ?>
                  <div class="echec" id="echec"><?= $text_erreur ?>
                        <button type="button" class="croix" onclick="cacheDiv('echec')">x</button>
                  </div>
        <?php 
        } 
        else { ?>
                <div class="succes" id="succes"><?= $text_erreur ?></div>
                <script>setTimeout('window.location = "index.php?action=supprRH"', 2000);</script>
        <?php  } 
        }
        ?>
  </div>
  <h5>Supprimer un Responsable RH</h5>
 
    <table class="tableau">
      <thead>
          <tr>
            <th>N° de Responsable</th>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Supprimer</th>
          </tr>
      </thead>

      <tbody>
      <?php if($liste_rh) :
              for ($i=$mapage->firstLine(); $i <= $mapage->lastLine(); $i++) : ?>   
                  <tr>
                    <td><?= $liste_rh[$i]['adminid'] ?></td>
                    <td><?= $liste_rh[$i]['nom'] ?></td>
                    <td><?= $liste_rh[$i]['prenom'] ?></td>
                    <!-- <td><button type="button" class="btn btn-danger" onclick="lanceModal('<?= $i ?>');">Supprimer</button></td> -->
                    <form action="index.php?action=supprRH" method="post">
                        <td style="display: none;"><input type="text" hidden name="adminid" value="<?= $liste_rh[$i]['adminid'] ?>" /></td>
                        <td style="display: none;"><input type="text" hidden name="nom" value="<?= $liste_rh[$i]['nom'] ?>" /></td>
                        <td style="display: none;"><input type="text" hidden name="prenom" value="<?= $liste_rh[$i]['prenom'] ?>" /></td>
                        <td><input type="submit" class="btn btn-danger validabs" name="submit"  value="Supprimer" /></td>
                    </form>
                  </tr>
              <?php
              endfor;
            else : ?>
                <tr><td colspan='5' style="color: white; background-color: dodgerblue; height: 40px;">Aucune employé enregistré à ce jour</td></tr>
            <?php
            endif;
            ?>
      </tbody>
    </table>
    <!-- <a href="#" data-bs-toggle="modal" data-bs-target="#suppremploye">Supprimer</a> -->
    <div class="pageform">  
        <ul class="pagination">

            <!-- Lien vers la page précédente (désactivé si on se trouve sur la 1ère page) -->
            <li class="page-item <?= ($mapage->getPage() == 1) ? "disabled" : "" ?>">
                <a href="index.php?action=supprRH&page=<?= $mapage->previousPage()->getPage() ?>" class="page-link"><<</a>
            </li>
                    
            <?php for ($i = 1; $i <= $mapage->getNbPages(); $i++) : ?>
                
                <!-- Lien vers chacune des pages (activé si on se trouve sur la page correspondante) -->
                <li class="page-item <?= ($mapage->getPage() == $i) ? "active" : "" ?>">
                    <a href="index.php?action=supprRH&page=<?= $mapage->getPage() ?>" class="page-link"><?= $i ?></a>
                </li>

            <?php endfor; ?>

            <!-- Lien vers la page suivante (désactivé si on se trouve sur la dernière page) -->
            <li class="page-item ">
                <a href="index.php?action=supprRH&page=<?= $mapage->nextPage()->getPage() ?>" class="page-link">>></a>    
            </li>
        </ul>                        
    </div>

</div>

<?php
include('./includes/footer.php');
?>