<?php
@session_start();

if (!isset($_SESSION['ident'])) {
  header('Location: index.php?action=accueil');
  exit();
}

require ('./includes/header.php');

$today = date('Y-m-d');

?>

<!-- <script>
  
  function cacheDiv('echec') {
    var div = document.getElementById('echec');
    div.style.display = "none";
  } 

</script> -->

<div class="register">

    <div class="bandeau"> 
        <?php if (isset($_POST ['submit'])) {
            if ($erreur) { ?>
                <div class="echec" id="echec">
                    <?= $text_erreur; ?>
                    <button type="button" class="croix" onclick="cacheDiv('echec')">x</button>
                </div>
        <?php } else { ?>

            <div class="succes" id="succes"><?php afficheDecompteSecondes($text_erreur, 3); ?></div>
            <script>
                setTimeout('window.location = "index.php?action=histo_point"', 3000);
            </script>

        <?php }
            }  
        ?>
    </div>

    <h5>Demande de modification de votre pointage du <strong><?= isset($pointage["Date"]) ? $pointage["Date"] : "" ?></strong></h5>

        <form method="POST" action="index.php?action=demModifPoint">
            <div class="connexion">
                <div class="identification">
                    <label for="ha">Heure Arrivée</label>
                    <input type="time" name="ha" id="ha" value="<?= $pointage['ha'] ?? $_POST['ha'] ?>" />

                    <label for="pm1">Pause méridienne 1</label>
                    <input type="time" name="pm1" id="pm1" required value="<?= $pointage['pm1'] ?? $_POST['pm1'] ?>" />

                    <label for="pm2">Pause méridienne 2</label>
                    <input type="time" name="pm2" id="pm2" required value="<?= $pointage['pm2'] ?? $_POST['pm2'] ?>" />

                    <label for="hd">Heure Départ</label>
                    <input type="time" name="hd" id="hd" required value="<?= $pointage['hd'] ?? $_POST['hd'] ?>" />
                    <input type="date" hidden name="date" value="<?= $today ?? $_POST['date'] ?>" >
                    <input type="text" hidden name="point_id" value="<?= $_GET['point_id'] ?? $_POST['point_id'] ?>" >
                </div>

                <div class="valid">
                    <input type="submit" class="btn btn-primary" name="submit" id="btn" value="Valider" title="Valider" />
                    <input type="submit" class="btn btn-primary" name="submit" id="btn" value="Retour" title="Retour" />
                </div>
            </div>
        </form>
</div>

<?php
  include('./includes/footer.php');
?>