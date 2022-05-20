<?php

session_start();

if (!isset($_SESSION['adminId'])) {
    header('Location: index.php?action=accueil');
    exit();
 }
 
 include('./includes/header.php');

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
                    <div class="echec" id="echec"><?= $text_erreur ?></div>
                        <script>
                            setTimeout('window.location = "index.php?action=modifPointage"', 2000);
                        </script>

            <?php } else {?>
                    <div class="succes" id="succes"><?= $text_erreur ?></div>
                        <script>
                            setTimeout('window.location = "index.php?action=modifPointage"', 2000);
                        </script>
            <?php }
            }
            ?>
    </div>

    <h5>Demande de modification de pointage du <strong><?= $pointage['date']?></strong>&nbsp;concernant l'employé&nbsp;<strong><?= $pointage['nom']." ".$pointage['prenom'] ?></strong></h5>
     
    <form  action="index.php?action=consultModif" method="POST">
        <div class="modification">
            <div class="pointage">
                <p>Pointage d'origine :</p>  
                <input type="time" readonly name="ha" value="<?= $pointage['ha'] ?>">
                <input type="time" readonly name="pm1" value="<?= $pointage['pm1'] ?>">
                <input type="time" readonly name="pm2" value="<?= $pointage['pm2'] ?>">
                <input type="time" readonly name="hd" value="<?= $pointage['hd'] ?>">
            </div>


            <div class="pointage">
                <p>Pointage modifié :</p>
                <input type="time" readonly name="ham" value="<?= $demande['ha'] ?>" style="color:<?php if($pointage['ha'] != $demande['ha']) echo 'red'; ?>">
                <input type="time" readonly name="pm1m" value="<?= $demande['pm1'] ?>" style="color:<?php if($pointage['pm1'] != $demande['pm1']) echo 'red'; ?>">
                <input type="time" readonly name="pm2m" value="<?= $demande['pm2'] ?>" style="color:<?php if($pointage['pm2'] != $demande['pm2']) echo 'red'; ?>">
                <input type="time" readonly name="hdm" value="<?= $demande['hd'] ?>" style="color:<?php if($pointage['hd'] != $demande['hd']) echo 'red'; ?>" >
            </div>

            <div class="valid">
                <input type="number" hidden name="demande" value="<?= $demande['id'] ?>">
                <input type="text" hidden name="pointage" value="<?= $pointage['id'] ?>">
                <input type="submit" class="btn btn-success" name="submit" id="ok" value="Valider" title="Valider" />
                <input type="submit" class="btn btn-danger" name="submit" id="notok" value="Refuser" title="Refuser" />
            </div>
            
        </div>
    </form>
</div>

<?php
 require('./includes/footer.php');
?>