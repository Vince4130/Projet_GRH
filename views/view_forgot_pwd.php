<?php
session_start();

if($_SESSION['userConnecte'] == true) {
    header('Location: index.php?action=welcome');
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
                <button type="button" class="croix" onclick="cacheDiv('echec')">x</button>
              </div>
      <?php } else { ?>
              <div class="succes" id="succes"><?php afficheDecompteSecondes($text_erreur, 3); ?></div>
              <script>
                setTimeout('window.location = "index.php?action=reinitPwd"', 3000);
              </script>
      <?php }
          }  
      ?>
    </div>

  <h5>Réinitialiser votre mot de passe</h5>

    <form action="index.php?action=forgotPwd" method="post">
        <div class="connexion">
          <div class="identification">
            <label for="email">Saisir votre email ci-dessous</label>
            <input type="email" id="email" name="email" required placeholder="email@exemple.com">
          </div>
          <div class="valid">
            <button class="btn btn-primary" type="submit" name="submit">Valider</button>
            <button class="btn btn-primary" type="submit" onclick="erase(email)">Effacer</button>
          </div>
        </div>
     </form>
  
</div>

<?php
include('./includes/footer.php');
?>