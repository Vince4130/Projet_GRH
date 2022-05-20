<?php

session_start();

if (!isset($_SESSION['ident'])) {
    redirection('accueil.php');
}

require('./includes/header.php');

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

    <h5>Saisir votre pointage</h5>

    <div class="formulaire">

        <form method="POST" action="index.php?action=pointage">
            <div class="saisie">

                <label for="date">Date&nbsp;<span>*</span></label>
                <input type="date" name="date" id="date" value="<?php echo $_SESSION['date']; ?>" style="border-color: <?php if (isset($_POST['submit']) && empty($date)) {echo $color;} ?>;" />

                <label for="ha">Heure Arrivée&nbsp;<span>*</span></label>
                <input type="time" name="ha" id="ha" value="<?php echo $_SESSION['ha']; ?>" style="border-color: <?php if (isset($_POST['submit']) && empty($ha)) echo $color; ?>;" />

                <label for="p1">Pause méridienne 1&nbsp;<span>*</span></label>
                <input type="time" name="p1" id="p1" value="<?php echo $_SESSION['p1']; ?>" style="border-color: <?php if (isset($_POST['submit']) && empty($p1)) echo $color; ?>;" />

                <label for="p2">Pause méridienne 2&nbsp;<span>*</span></label>
                <input type="time" name="p2" id="p2" value="<?php echo $_SESSION['p2']; ?>" style="border-color : <?php if (isset($_POST['submit']) && empty($p2)) echo $color; ?>;" />

                <label for="hd">Heure Départ&nbsp;<span>*</span></label>
                <input type="time" name="hd" id="hd" value="<?php echo $_SESSION['hd']; ?>" style="border-color : <?php if (isset($_POST['submit']) && empty($hd)) echo $color; ?>;" />

                <div class="bouton">
                    <input type="submit" class="btn btn-primary" name="submit" id="btn" value="Valider" title="Valider" />
                    <input type="submit" class="btn btn-primary" name="submit" id="raz" value="Effacer" title="Effacer" />
                </div>
            </div>
        </form>
    </div>
    <h6 style="margin-top: 30px;"><span>*&nbsp;</span>Champs obligatoires</h6>
</div>

<?php
require('./includes/footer.php');
?>