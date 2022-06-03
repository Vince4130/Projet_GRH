<?php
session_start();

if (!isset($_SESSION['ident'])) {
    header('Location: index.php?action=accueil');
    exit();
}
  
require('./includes/header.php');

?>

<div class="register">
    <div class="bandeau"> 
            <?php if (isset($_POST ['submit'])) {
                if ($erreur) { ?>
                    <div class="echec" id="echec">
                        <?= $text_erreur ?>
                        <button type="button" class="croix" onclick="retour('pointage')">x</button>
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

    <h5>Vos pointages du <?php echo $date = date('d/m/Y', strtotime($_SESSION['date']))  ?></h5>
       
    <form action="index.php?action=resultats" method="POST" >        
        <div class="connexion">
            <div class="identification">
                <label for="ha">Heure Arrivée</label>
                <input type="time" name="ha" id="ha" readonly value="<?php echo gmdate('H:i',$_SESSION['heureA']); ?>" />

                <label for="hd">Heure Départ</label>
                <input type="time" name="hd" id="hd" readonly value="<?php echo gmdate('H:i',$_SESSION['heureD']); ?>" />

                <label for="pause">Pause Méridienne</label>
                <input type="time" name="pause" id="pause" readonly value="<?php echo $_SESSION['pause'] ?>" />

                <label for="credit">Solde du jour</label>
                <input type="text" name="credit" id="credit" readonly value="<?php echo $_SESSION['creditRes']?>" 
                style="color: <?php echo (($_SESSION['credit'][0] == '-') || ($_SESSION['credit'][0] == 'E')) ? "red" : "limegreen" ?>;" />
            </div>
            <div class="valid">
                <input class="btn btn-primary" type="submit" name="submit" value="Valider" title="Validation horaires" />
                <input class="btn btn-primary" type="submit" name="submit" value="Retour" title="Page précédente" />
            </div>    
        </div>
    </form>
        
</div>

<?php
include('./includes/footer.php');
?>