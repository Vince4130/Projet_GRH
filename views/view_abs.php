<?php

session_start();

if (!isset($_SESSION['ident'])) {
    redirection('index.php?action=accueil');
}

require('./includes/header_2.php');

?>

<div class="register">

<script>
  
  function cacheDiv() {
    var div = document.getElementById('test');
    div.style.display = "none";
  } 

</script>

<div class="register">

    <div class="bandeau"> 
        <?php if (isset($_POST ['submit']) && $_POST['submit'] == "Crédit/Débit") {
            if ($erreur) { ?>
            <div class="echec" id="test">
                <?php echo $text_erreur; ?>
                <button type="button" class="croix" onclick="cacheDiv()">x</button>
            </div>

        <?php } 
        }  
        ?>
    </div>

    <h5>Saisir votre demande d'absence</h5>

    <div class="formulaire">

        <form action="index.php?action=absences" method="post">
            <div class="saisie">
                <label for="type_abs">Motif</label>
                <select name="type_abs" id="type_abs">
                    <option value="conges">Congés</option>
                    <option value="formation">Formation</option>
                </select>

                <label for="date_deb">Date de début&nbsp;<span>*</span></label>
                <input type="date" name="date_deb" id="date_deb" value="<?php echo $_SESSION['date']; ?>" style="border-color: <?php if (isset($_POST['submit']) && empty($date)) {echo $color;} ?>;" />

                <label for="date">Date de fin&nbsp;<span>*</span></label>
                <input type="date" name="date_fin" id="date_fin" value="<?php echo $_SESSION['date']; ?>" style="border-color: <?php if (isset($_POST['submit']) && empty($date)) {echo $color;} ?>;" />

                <div class="bouton">
                    <input type="submit" class="btn btn-primary" name="submit" id="btn" value="Valider" title="Valider" />
                    <input type="submit" class="btn btn-primary" name="submit" id="raz" value="Effacer" title="Effacer" />
                </div>
            </div>
        </form>
    </div>
    <h6 style="margin-top: 30px;"><span>*&nbsp;</span>Champs obligatoires</h6>
</div>
</div>

<?php
require('./includes/footer.php');
?>