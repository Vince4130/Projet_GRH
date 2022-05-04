<?php

@session_start();

if (!isset($_SESSION['ident'])) {
    redirection('index.php?action=accueil');
}

require('./includes/header_admin.php');

?>

<div class="register">
    <h5>Demande de modification de pointage du <strong><?= $pointage['date']?></strong>&nbsp;concernant l'employé&nbsp;<strong><?= $pointage['nom']." ".$pointage['prenom'] ?></strong></h5>

    <table class="tableau">
        <thead style="border-bottom-color: black">
            <tr>
                <th>Comparaison</th>
                <th>Heure Arrivée</th>
                <th>Pause Méridienne 1</th>
                <th>Pause Méridienne 2</th>
                <th>Heure Départ</th>
            </tr>
        
        </thead>

        <tbody>
        
            <tr>
                <td>Pointage d'origine</td>
                <td><?= $pointage['ha'] ?></td>
                <td><?= $pointage['pm1'] ?></td>
                <td><?= $pointage['pm2'] ?></td>
                <td><?= $pointage['hd'] ?></td>
            
            </tr>
            <tr>
                <td>Pointage modifié</td>
                <?php
                foreach($demande as $val) {
                    echo "<td>$val</td>";
                } ?>
            </tr>
        </tbody>
    </table>

    <form action="index.php?action=consultModif" method="POST">
        <div class="validpoint">
            <input type="submit" class="btn btn-success" name="submit" id="ok" value="Valider" title="Valider" />
            <input type="submit" class="btn btn-danger" name="submit" id="notok" value="Refuser" title="Refuser" />   
        </div>
    </form>

</div>


<?php
 require('./includes/footer.php');
?>