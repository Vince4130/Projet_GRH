<?php
// session_start();

if($_SESSION['userConnecte'] == true) {
    header('Location: index.php?action=welcome');
    exit();
}

include('./includes/header.php');

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
            <div class="succes" id="succes"><<?php afficheDecompteSecondes($text_erreur, 3); ?></div>
            <script>
                setTimeout('window.location = "index.php?action=connect"', 3000);
            </script>
        <?php }
            }  
        ?>
    </div>

    <h5>Saisir un nouveau mot de passe</h5>

    <form action="index.php?action=reinitPwd" method="post">
        <div class="connexion">
            <div class="identification">
            <label for="mdp1">Nouveau mot de passe</label>
            <input type="text" id="mdp1" name="mdp1" required style="border-color: <?php if (empty($_POST['mdp1']) && $submit == "Valider") echo "red"; ?>"; >
            
            <label for="mdp2">Vérification mot de passe</label>
            <input type="password" id="mdp2" name="mdp2" required style="border-color: <?php if (isset($_POST['submit']) && empty($_POST['mdp2'])) echo "red"; ?>"; >
            </div>

            <div class="valid">
                <button class="btn btn-primary" type="submit" name="submit">Valider</button>
            </div>
        </div>
    </form>
</div>

<?php
include('./includes/footer.php');
?>
