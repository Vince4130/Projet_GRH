<?php

@session_start();

if (!isset($_SESSION['ident'])) {
    redirection('index.php?action=accueil');
}

require('./includes/header_admin.php');

?>
    
    
    <!-- <table class="tableau">
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
                <td><?= $demande['ha'] ?></td>
                <td><?= $demande['pm1'] ?></td>
                <td><?= $demande['pm2'] ?></td>
                <td><?= $demande['hd'] ?></td>
            </tr>
        </tbody>
    </table>

    <form action="index.php?action=consultModif" method="POST">
        <div class="validpoint">
            <input type="text" hidden name="demande" value="<?= $demande['id'] ?>">
            <input type="text" hidden name="pointage" value="<?= $pointage['i'] ?>">
            <input type="submit" class="btn btn-success" name="submit" id="ok" value="Valider" title="Valider" />
            <input type="submit" class="btn btn-danger" name="submit" id="notok" value="Refuser" title="Refuser" />   
        </div>
    </form> -->
<div class="register">
<div class="bandeau">
        <?php if (isset($_POST['submit'])) {
            if ($erreur) {?>
                <div class="echec" id="echec">
                    <?= $text_erreur ?>
                    <button type="button" class="croix" onclick="cacheDiv()">x</button>
                </div>

        <?php } else {?>
                <div class="succes" id="succes"><?= $text_erreur ?></div>
                    <script>
                        setTimeout('window.location = "index.php?action=welcome"', 2000);
                    </script>
        <?php }
        }
        ?>
    </div>
    <h5>Demande de modification de pointage du <strong><?= $pointage['date']?></strong>&nbsp;concernant l'employé&nbsp;<strong><?= $pointage['nom']." ".$pointage['prenom'] ?></strong></h5>
    <div class="modification">
     
        <div class="pointage">
            <p>Pointage d'origine :</p>  
            <input type="time" readonly name="ha" value="<?= $pointage['ha'] ?>">
            <input type="time" readonly name="pm1" value="<?= $pointage['pm1'] ?>">
            <input type="time" readonly name="pm1" value="<?= $pointage['ha'] ?>">
            <input type="time" readonly name="hd" value="<?= $pointage['hd'] ?>">
        </div>


        <div class="pointage">
            <p>Pointage modifié :</p>
            <input type="time" readonly name="ha" value="<?= $demande['ha'] ?>">
            <input type="time" readonly name="pm1" value="<?= $demande['pm1'] ?>">
            <input type="time" readonly name="pm1" value="<?= $demande['ha'] ?>">
            <input type="time" readonly name="hd" value="<?= $demande['hd'] ?>">
        </div>

        <div class="valid">
            <input type="submit" class="btn btn-success" name="submit" id="ok" value="Valider" title="Valider" />
            <input type="submit" class="btn btn-danger" name="submit" id="notok" value="Refuser" title="Refuser" />
        </div>
    </div>
</div>
<?php
 require('./includes/footer.php');
?>