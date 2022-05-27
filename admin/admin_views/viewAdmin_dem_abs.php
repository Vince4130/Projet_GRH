<?php
session_start();

if (!isset($_SESSION['adminIdent'])) {
    header('Location: index.php?action=accueil');
    exit();
}
  
require ('./includes/header.php');

?>

<div class="register">
     
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
    
       <?php foreach($tab_all_dem as $tab) : ?>
            <tr>
                <td><?= inverseDate($tab['date_dem']) ?></td>
                <td><?= $tab['empid'] ?></td>
                <td><?= $tab['nom'] ?></td>
                <td><?= $tab['prenom'] ?></td>
                <td><?= $tab['libelle'] ?></td>
                <td><?= inverseDate($tab['date_deb']) ?></td>
                <td><?= inverseDate($tab['date_fin']) ?></td>

                <form action="index.php?action=validAbs" method="post">
                    <td style="display: none;"><input type="text" hidden name="demabsid" value="<?= $tab['demabsid'] ?>" /></td>
                    <td><input type="submit" class="btn btn-success" name="submit"  value="Valider" /></td>
                    <td><input type="submit" class="btn btn-primary btn-danger" name="submit"  value="Refuser" /></td>
                </form>

        <?php endforeach; ?>
            </tr>
        </tbody>
    </table>
                        
</div>

<?php 
 require('./includes/footer.php');
?>



