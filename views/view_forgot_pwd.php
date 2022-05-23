<?php
session_start();

if($_SESSION['userConnecte'] == true) {
    header('Location: index.php?action=welcome');
    exit();
}

require('./includes/header.php');

?>

<script>
  
  function cacheDiv() {
    var div = document.getElementById('echec');
    div.style.display = "none";
  } 

</script>


<div class="register">

    <div class="bandeau"> 

      <?php if (isset($_POST ['submit'])) {
          if ($erreur) { ?>
          <div class="echec" id="echec">
          <?php echo $text_erreur; ?>
          <button type="button" class="croix" onclick="cacheDiv()">x</button>
          </div>
      <?php } else { ?>
          <div class="succes" id="succes"><?php echo $text_erreur; ?></div>
          <script>
          setTimeout('window.location = "index.php?action=reinitPwd"', 3000);
          </script>

      <?php }
          }  
      ?>
    </div>

  <h5>Réinitialiser votre mot de passe</h5>

  <div class="formulaire">
    <form action="index.php?action=forgotPwd" method="post">
        <div class="saisie">
          <label for="email">Saisir votre email ci-dessous</label>
          <input type="email" id="email" name="email" required placeholder="email@exemple.com">

          <div class="bouton">
            <button class="btn btn-primary" type="submit" name="submit">Valider</button>
          </div>
        </div>
     </form>
  </div>
</div>

<?php
include('./includes/footer.php');
?>