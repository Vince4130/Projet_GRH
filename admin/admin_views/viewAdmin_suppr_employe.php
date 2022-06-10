<?php
session_start();

if (!isset($_SESSION['adminIdent'])) {
   header('Location: index.php?action=accueil');
   exit();
}

include('./includes/header.php');
include('./includes/modal_supprEmp.php');

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
  
  <h5>Supprimer un employé</h5>
 
    <table class="tableau">
      <thead>
          <tr>
            <th>N° employé</th>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Supprimer</th>
          </tr>
      </thead>

      <tbody>
      <?php if($liste_employes) :
              for ($i=$mapage->firstLine(); $i <= $mapage->lastLine(); $i++) : ?>   
                  <tr>
                    <td><?= $liste_employes[$i]['empid'] ?></td>
                    <td><?= $liste_employes[$i]['nom'] ?></td>
                    <td><?= $liste_employes[$i]['prenom'] ?></td>
                    <!-- <td><button type="button" class="btn btn-danger" onclick="lanceModal('<?= $i ?>');">Supprimer</button></td> -->
                    <form action="index.php?action=supprEmploye" method="post">
                        <td style="display: none;"><input type="text" hidden name="empid" value="<?= $liste_employes[$i]['empid'] ?>" /></td>
                        <td style="display: none;"><input type="text" hidden name="nom" value="<?= $liste_employes[$i]['nom'] ?>" /></td>
                        <td style="display: none;"><input type="text" hidden name="prenom" value="<?= $liste_employes[$i]['prenom'] ?>" /></td>
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
                <a href="index.php?action=supprEmploye&page=<?= $mapage->previousPage()->getPage() ?>" class="page-link"><<</a>
            </li>
                    
            <?php for ($i = 1; $i <= $mapage->getNbPages(); $i++) : ?>
                
                <!-- Lien vers chacune des pages (activé si on se trouve sur la page correspondante) -->
                <li class="page-item <?= ($mapage->getPage() == $i) ? "active" : "" ?>">
                    <a href="index.php?action=supprEmploye&page=<?= $mapage->getPage() ?>" class="page-link"><?= $i ?></a>
                </li>

            <?php endfor; ?>

            <!-- Lien vers la page suivante (désactivé si on se trouve sur la dernière page) -->
            <li class="page-item ">
                <a href="index.php?action=supprEmploye&page=<?= $mapage->nextPage()->getPage() ?>" class="page-link">>></a>    
            </li>
        </ul>                        
    </div>

</div>

<?php
include('./includes/footer.php');
?>