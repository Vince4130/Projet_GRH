<?php

session_start();

if (!isset($_SESSION['ident'])) {
    header('Location: index.php?action=accueil');
    exit();
}
  
require('./includes/header.php');

?>

<script>
  
  function retour() {
    window.location.href = "index.php?action=pointage";
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
                    setTimeout('window.location = "index.php?action=histo_point"', 3000);
                </script>

            <?php }
                }  
            ?>
    </div>

    <h5>Vos pointages du <?php echo $date = date('d/m/Y', strtotime($_SESSION['date']))  ?></h5>
       
        <div class="formulaire">
            <form action="index.php?action=resultats" method="POST" >
                <div class="saisie">

                    <label for="ha">Heure Arrivée</label>
                    <input type="time" name="ha" id="ha" readonly value="<?php echo gmdate('H:i',$_SESSION['heureA']); ?>" />

                    <label for="hd">Heure Départ</label>
                    <input type="time" name="hd" id="hd" readonly value="<?php echo gmdate('H:i',$_SESSION['heureD']); ?>" />

                    <label for="pause">Pause Méridienne</label>
                    <input type="time" name="pause" id="pause" readonly value="<?php echo $_SESSION['pause'] ?>" />

                    <label for="credit">Solde du jour</label>
                    <input type="text" name="credit" id="credit" readonly value="<?php echo $_SESSION['creditRes']?>" 
                    style="color: <?php echo (($_SESSION['credit'][0] == '-') || ($_SESSION['credit'][0] == 'E')) ? "red" : "limegreen" ?>;" />

                    <div class="bouton">
                        <input class="btn btn-primary" type="submit" name="submit" value="Valider" title="Validation horaires" />
                        <input class="btn btn-primary" type="submit" name="submit" value="Retour" title="Page précédente" />
                    </div>
                </div>
            </form>
        </div>
</div>
<?php
include('./includes/footer.php');
?>