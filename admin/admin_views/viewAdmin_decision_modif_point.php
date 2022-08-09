<?php
session_start();

if (!isset($_SESSION['adminIdent'])) {
    header('Location: index.php?action=accueil');
    exit();
 }
 
 include('./includes/header.php');

?>

<div class="register">
    <div class="bandeau">
        <?php if (isset($_POST['submit'])) {
            if ($erreur) {?>
                <div class="echec" id="echec"><?php afficheDecompteSecondes($text_erreur, 2); ?></div>
                    <script>
                        setTimeout('window.location = "index.php?action=modifPointage"', 2000);
                    </script>

        <?php } else {?>
                <div class="succes" id="succes"><?php afficheDecompteSecondes($text_erreur, 3); ?></div>
                    <script>
                        setTimeout('window.location = "index.php?action=modifPointage"', 2000);
                    </script>
        <?php }
        }
        ?>
    </div>

    <h5>Demande de modification de pointage du <strong><?= isset($pointage['date']) ? $pointage['date'] : ""?></strong>&nbsp;concernant l'employé&nbsp;<strong><?= (isset($pointage['nom']) ? $pointage['nom'] : "")." ".(isset($pointage['prenom']) ? $pointage['prenom'] : "") ?></strong></h5>
     
    <form  action="index.php?action=consultModif" method="post">
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
                <input type="submit" class="btn btn-primary btn-success" name="submit" id="ok" value="Valider" title="Valider" />
                <input type="submit" class="btn btn-primary btn-danger" name="submit" id="notok" value="Refuser" title="Refuser" />
            </div>
            
        </div>
    </form>
</div>

<?php
 require('./includes/footer.php');
?>