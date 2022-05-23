<?php
include('./includes/header.php');
?>

<div class="main">

  <div class="accueil">
    <h5>Identifiez-vous</h5>
    <div class="bienvenue">
      
      <!-- <div class="ident">
        <h5>Identifiez-vous</h5>
        <hr>
      </div> -->

      <div class="cl">
        
        <div class="compte">
          <p>Vous avez déjà un compte :</p>
          <a href="index.php?action=connect"><input class="btn btn-primary" type="button" value="Se Connecter" /></a>
        </div>

        <div class="compte">
          <p>Vous n'avez pas de compte :</p>
          <a href="index.php?action=registration"><input class="btn btn-primary" type="button" value="S'enregistrer" /></a>
        </div>
      </div>
    </div>
  </div>
</div> <!-- div main  -->

<?php
include('./includes/footer.php');
?>



