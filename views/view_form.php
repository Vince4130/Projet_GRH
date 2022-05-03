<?php

session_start();

if (!isset($_SESSION['ident'])) {
    redirection('index.php?action=accueil');
}

include('./includes/header_2.php');

$today = date('Y-m-d');
?>

<script>
  
  function cacheDiv() {
    var div = document.getElementById('test');
    div.style.display = "none";
  } 

</script>

<div class="register">

    <div class="bandeau"> 
            <?php if (isset($_POST ['submit'])) {
                if ($erreur) { ?>
                <div class="echec" id="echec">
                <?php echo $text_erreur; ?>
                <button type="button" class="croix" onclick="retour()">x</button>
                </div>

            <?php } else { ?>

                <div class="succes" id="succes"><?php echo $text_erreur; ?></div>
                <script>
                    setTimeout('window.location = "index.php?action=dem_modif_pointage"', 3000);
                </script>

            <?php }
                }  
            ?>
    </div>

    <h5>Demande de modification de votre pointage du <strong><?= $pointage["Date"] ?></strong></h5>

    <div class="formulaire">

        <form method="POST" action="index.php?action=formulaire">
            <div class="saisie">
               <label for="ha">Heure Arrivée</label>
                <input type="time" name="ha" id="ha" value="<?= $pointage['ha']; ?>" />

                <label for="p1">Pause méridienne 1</label>
                <input type="time" name="p1" id="p1" value="<?= $pointage['pm1']; ?>" />

                <label for="p2">Pause méridienne 2</label>
                <input type="time" name="p2" id="p2" value="<?= $pointage['pm2']; ?>" />

                <label for="hd">Heure Départ</label>
                <input type="time" name="hd" id="hd" value="<?= $pointage['hd']; ?>" />
                <input type="date" hidden name="date" value="<?= $today ?>" >
                <div class="bouton">
                    <input type="submit" class="btn btn-primary" name="submit" id="btn" value="Valider" title="Valider" />
                    <input type="submit" class="btn btn-primary" name="submit" id="btn" value="Retour" title="Retour" />
                </div>
            </div>
        </form>
    </div>
</div>

<?php
  include('./includes/footer.php');
?>