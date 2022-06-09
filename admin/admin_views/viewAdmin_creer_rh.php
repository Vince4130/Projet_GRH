<?php
session_start();

include('./includes/header.php');

?>

<div class="register">

<?php if (isset($_POST ['submit']) && $_POST['submit'] == "Valider") {     
      
      if ($exist) { ?>     
        <div class="echec" id="echec"><?= $text_erreur; ?>
            <button type="button" class="croix" onclick="cacheDiv('echec')">x</button>
        </div>

      <?php }         
            else { 
                if ($erreur) { ?>
                  <div class="echec" id="echec"><?= $text_erreur ?>
                        <button type="button" class="croix" onclick="cacheDiv('echec')">x</button>
                  </div>

                <?php 
                } 
                else { ?>
                          <div class="succes" id="succes"><?php afficheDecompteSecondes($text_erreur, 3); ?></div>

                          <script>setTimeout('window.location = "index.php?action=adminAccueil"', 3000);</script>
                <?php  }
            }
      } 
      ?>
  </div>

  <h5>Enregistrer un responsable RH</h5>
  
      <form  action="index.php?action=creerRH" method="post">
        
        <div class="registration">

          <div class="civilite">
            <label for="nom">Nom</label>
            <input type="text" name="nom" id="nom" value="<?= $_POST['nom'] ?>" style="border-color: <?php if (empty($_POST['nom']) && $submit == "Valider") echo "red"; ?>"; >

            <label for="prenom">Prénom</label>
            <input type="text" name="prenom" id="prenom" value="<?= $_POST['prenom'] ?>" style="border-color: <?php if (empty($_POST['prenom']) && $submit == "Valider") echo "red"; ?>"; >
          </div>

          <div class="civilite">
            <label for="ident">Identifiant</label>
            <input type="text" name="ident" id="ident" value="<?= $_POST['ident'] ?>"style="border-color: <?php if (empty($_POST['ident']) && $submit == "Valider") echo "red"; ?>"; >
          
            <label for="passwd" >Mot de passe</label>
            <input type="text" name="passwd" id="passwd" readonly value="<?= $_POST['passwd'] ?>" style="border-color: <?php if (empty($_POST['passwd']) && $submit == "Valider") echo "red"; ?>"; >
          </div>

         
          
          <div class="valid">
            <input class="btn btn-primary" type="submit" name="submit" value="Valider" />
            <input class="btn btn-primary" type="submit" name="submit" value="Effacer" /> 
          </div>
          
        </div>

      </form>
</div>

<?php
include('./includes/footer.php');
?>