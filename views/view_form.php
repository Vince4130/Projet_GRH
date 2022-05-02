<?php

session_start();

if (!isset($_SESSION['ident'])) {
    redirection('index.php?action=accueil');
}

include('./includes/header_2.php');
?>

<script>
  
  function cacheDiv() {
    var div = document.getElementById('test');
    div.style.display = "none";
  } 

</script>

<div class="register">

    <div class="bandeau"> 
        <?php if (isset($_POST ['submit']) && $_POST['submit'] == "Valider") {
            if ($erreur) { ?>
            <div class="echec" id="test">
                <?php echo $text_erreur; ?>
                <button type="button" class="croix" onclick="cacheDiv()">x</button>
            </div>

        <?php } 
        }  
        ?>
    </div>

    <h5>Demande de modification de votre pointage du <?= $pointage["Date"] ?></h5>

    <div class="formulaire">

        <form method="POST" action="404.php">
            <div class="saisie">
               <label for="ha">Heure Arrivée</label>
                <input type="time" name="ha" id="ha" value="<?= $pointage['ha']; ?>" />

                <label for="p1">Pause méridienne 1</label>
                <input type="time" name="p1" id="p1" value="<?= $pointage['pm1']; ?>" />

                <label for="p2">Pause méridienne 2</label>
                <input type="time" name="p2" id="p2" value="<?= $pointage['pm2']; ?>" />

                <label for="hd">Heure Départ</label>
                <input type="time" name="hd" id="hd" value="<?= $pointage['hd']; ?>" />

                <div class="bouton">
                    <input type="submit" class="btn btn-primary" name="submit" id="btn" value="Valider" title="Valider" />
                </div>
            </div>
        </form>
    </div>
</div>

<?php
  include('./includes/footer.php');
?>