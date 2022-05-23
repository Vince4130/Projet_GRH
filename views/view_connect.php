<?php
session_start();

if($_SESSION['userConnecte'] == true) {
    header('Location: index.php?action=welcome');
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
                    <button type="button" class="croix" onclick="cacheDiv()">x</button>
                </div>

        <?php } else {?>
                <div class="succes" id="succes"><?= $text_erreur ?></div>
                    <script>
                        setTimeout('window.location = "index.php?action=welcome"', 2000);
                    </script>
        <?php }
        }
        ?>
    </div>

    <h5>Se connecter</h5>
    
    <form action="index.php?action=connect" method="POST">        
        <div class="connexion">    
            <div class="identification">
                <label for="login">Identifiant</label>
                <input type="text" id="login" name="login" required>
                <label for="passwrd">Mot de passe</label>
                <input type="password" id="passwrd" name="passwrd" required>
            </div>

            <div class="valid">
                <button class="btn btn-primary" type="submit" name="submit">Valider</button>
                <!-- <button class="btn btn-primary" type="submit" onclick="erase()">Effacer</button> -->
            </div>
            <div class="mdpo"><a href="index.php?action=forgotPwd">Mot de passe oublié ?</a></div>
        </div>
    </form>
</div>

<?php
include('./includes/footer.php');
?>
