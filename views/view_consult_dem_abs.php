<?php
session_start();

if (!isset($_SESSION['ident'])) {
  header('Location: index.php?action=accueil');
  exit();
}

require ('./includes/header.php');

?>

<div class="register">
    <div class="bandeau"> 
        <?php if (isset($_POST ['submit'])) {
            if ($erreur) { ?>
            <div class="echec" id="echec">
                <?= $text_erreur; ?>
                <button type="button" class="croix" onclick="cacheDiv()">x</button>
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
        <thead style="border-bottom-color: black">
            <tr>
                <th>Date demande</th>
                <th>Motif absence</th>
                <th>Date début</th>
                <th>Date fin</th>
                <th>Nombre de jours décomptés</th>
                <th>Statut</th>
                <th>Supprimer</th>
            </tr>
        </thead>

        <tbody>
            <?php if($dem_abs) :
                foreach($dem_abs as $dem) : ?>        
                    <tr>
                        <td><?= formatDate(inverseDAte($dem['date_dem'])) ?></td>
                        <td><?= $dem['libelle'] ?></td>
                        <td><?= formatDate(inverseDAte($dem['date_deb'])) ?></td>
                        <td><?= formatDate(inverseDAte($dem['date_fin'])) ?></td>
                        <td><?= $dem['nb_j'] ?></td>
                        <td><span class="<?= ($dem['etat'] == 'En attente') ? 'attente' : (($dem['etat'] == 'Acceptée' ? 'acceptee' : 'refusee')) ?>" ><?= $dem['etat'] ?></span></td>
                        <form action="index.php?action=consultDemAbs" method="post">
                            <input type="text" hidden name="abs_id" value="<?= $dem['demabsid'] ?>" />
                            <td><button type="submit" name="submit" class="btn btn-edit"><i class="fa fa-edit"></button></td> 

                        </form>
                        <!-- <button class="btn btn-edit" onclick="location.href='index.php?action=consultDemAbs&abs_id=<?= $dem['demabsid'] ?>'"><i class="fa fa-edit"></i></button></td>              -->
                    </tr>
                <?php
                endforeach;
            else : ?>
                <tr><td colspan='7' style="color: white; background-color: dodgerblue; height: 40px;">Aucune demande à ce jour</td></tr>
            <?php
            endif;
            ?>
        </tbody>
    </table>
</div>

<?php
 require('./includes/footer.php');
?>