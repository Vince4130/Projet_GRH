<?php
session_start();

if (!isset($_SESSION['ident'])) {
    header('Location: index.php?action=accueil');
    exit();
}
  
require ('./includes/header.php');

?>

<div class="register">

    <div class="bandeau"> 
        <?php if (isset($_POST ['submit'])) {
            if ($erreur) { ?>
            <div class="echec" id="echec">
                <?= $text_erreur ?>
                <button type="button" class="croix" onclick="cacheDiv('echec')">x</button>
            </div>
        <?php } else { ?>
            <div class="succes" id="succes"><?php afficheDecompteSecondes($text_erreur, 3); ?></div>
                <script>
                    setTimeout('window.location = "index.php?action=consultDemAbs"', 3000);
                </script>

        <?php }
            }  
        ?>
    </div>

    <h5>Saisir votre demande d'absence</h5>

    <form action="index.php?action=absences" method="post">

        <div class="connexion">
            <div class="identification">
                <label for="typeabs">Motif&nbsp;<span>*</span></label>
                <select name="typeabs" id="typeabs" autofocus>
                    <option value="Congés">Congés</option>
                    <option value="Formation">Formation</option>
                </select>

                <label for="date_deb">Date de début&nbsp;<span>*</span></label>
                <input type="date" name="date_deb" id="date_deb" required value="<?= $_POST['date_deb'] ?>" />

                <label for="date_fin">Date de fin&nbsp;<span>*</span></label>
                <input type="date" name="date_fin" id="date_fin" required  value="<?= $_POST['date_fin'] ?>" />
            </div>

            <div class="valid">
                <input type="submit" class="btn btn-primary" name="submit" id="btn" value="Valider" title="Valider" />
                <input type="reset" class="btn btn-primary" name="reset" id="raz" value="Effacer" title="Effacer" />
                <!-- <button type="submit" class="btn btn-primary" name="submit">Valider</button>
                <button type="reset" class="btn btn-primary" >Effacer</button> -->
            </div>
        </div>   
    </form>
    <h6 class="champs"><span>*&nbsp;</span>Champs obligatoires</h6>
</div>

<?php
require('./includes/footer.php');
?>