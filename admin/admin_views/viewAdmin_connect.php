<?php
session_start();

if($_SESSION['adminConnecte'] == true) {
    header('Location: index.php?action=adminAccueil');
    exit();
}

require ('./includes/header.php');

?>

<div class="register">

    <div class="bandeau">
        <?php if (isset($_POST['submit'])) {
             
            if ($erreur) {?>
                <div class="echec" id="echec">
                    <?= $text_erreur ?>
                    <button type="button" class="croix" onclick="cacheDiv('echec')">x</button>
                </div>

        <?php } else { ?>
                <div class="succes" id="succes"><?php afficheDecompteSecondes($text_erreur, 3); ?></div>
                    <script>
                        setTimeout('window.location = "index.php?action=adminAccueil"', 3000);
                    </script>
        <?php }
        }
        ?>
    </div>

<h5>Authentification Administrateur</h5>

    <form action="index.php?action=adminConnect" method="post">
        <div class="connexion">
            <div class="identification">
                <label for="login">Identifiant</label>
                <input type="text" id="login" name="login" required>

                <label for="passwrd">Mot de passe</label>
                <input type="password" id="passwrd" name="passwrd" required>
            </div>
            <div class="valid">
                <button class="btn btn-primary" type="submit" name="submit">Valider</button>
            </div>
        </div>
    </form>
<!-- <div class="mdpo"><a href="index.php?action=forgotpassword">Mot de passe oublié ?</a></div> -->
</div>

<?php
include('./includes/footer.php');
?>