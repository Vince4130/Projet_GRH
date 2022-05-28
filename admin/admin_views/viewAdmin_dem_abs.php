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
                    <button type="button" class="croix" onclick="cacheDiv()">x</button>
                </div>
        <?php } else {?>
                <div class="succes" id="succes"><?= $text_erreur ?></div>
                    <!-- <script>
                        setTimeout('window.location = "index.php?action=validAbs"', 2000);
                    </script> -->
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
    
        <?php foreach($tab_all_dem as $tab) : 
                $attente [] = $tab['etat'];
                if($tab['etat'] == "En attente") : ?>
                <tr>
                    <td><?= formatDate(inverseDate($tab['date_dem'])) ?></td>
                    <td><?= $tab['empid'] ?></td>
                    <td><?= $tab['nom'] ?></td>
                    <td><?= $tab['prenom'] ?></td>
                    <td><?= $tab['libelle'] ?></td>
                    <td><?= formatDate(inverseDate($tab['date_deb'])) ?></td>
                    <td><?= formatDate(inverseDate($tab['date_fin'])) ?></td>

                    <form action="index.php?action=validAbs" method="post">
                        <td style="display: none;"><input type="text" hidden name="demabsid" value="<?= $tab['demabsid'] ?>" /></td>
                        <td><input type="submit" class="btn btn-success validabs" name="submit" value="Valider" /></td>
                        <td><input type="submit" class="btn btn-danger validabs" name="submit"  value="Refuser" /></td>
                    </form>
                </tr>
            <?php
                endif;
            endforeach;

            if (!in_array("En attente", $attente)) :?>          
                <tr><td colspan='10' style="color: white; background-color: dodgerblue; height: 40px;">Aucune demande d'absence en attente</td></tr>
            <?php 
            endif;  
        ?>            
        </tbody>
    </table>
                        
</div>

<?php 
 require('./includes/footer.php');
?>



