<?php

session_start();

include('./includes/header.php');

?>


<script>
  
  function cacheDiv() {
    var div = document.getElementById('echec');
    div.style.display = "none";
  } 

</script>

<div class="register">

  <div class="bandeau">

    <?php if (isset($_POST ['submit']) && $_POST['submit'] == "Valider") {     
      
      if ($exist) { ?>     
        <div class="echec" id="echec"><?= $text_erreur; ?>
            <button type="button" class="croix" onclick="cacheDiv()">x</button>
        </div>

      <?php }         
            else { 
                if ($erreur) { ?>
                  <div class="echec" id="echec"><?= $text_erreur; ?>
                        <button type="button" class="croix" onclick="cacheDiv()">x</button>
                  </div>

                <?php 
                } 
                else { ?>
                          <div class="succes" id="succes"><?= $text_erreur; ?></div>

                          <script>setTimeout('window.location = "index.php?action=connect"', 4000);</script>
                <?php  }
            }
      } 
      ?>
  </div>

  <h5>S'enregistrer</h5>
    <div class="formulaire">
      <form  action="index.php?action=registration" method="POST">

        <div class="saisie">
          <label for="nom">Nom</label>
          <input type="text" name="nom" id="nom" value="<?= $nom ?>" style="border-color: <?php if (empty($nom) && $submit == "Valider") echo "red"; ?>"; >

          <label for="prenom">Prénom</label>
          <input type="text" name="prenom" id="prenom" value="<?= $prenom ?>" style="border-color: <?php if (empty($prenom) && $submit == "Valider") echo "red"; ?>"; >
        </div>

        <div class="saisie">
          <label for="mail">Email</label>
          <input type="text" name="mail" id="mail" placeholder="email@exemple.com" value="<?= $mail ?>" style="border-color: <?php if (empty($mail) && $submit == "Valider") echo "red"; ?>"; >
          <label for=""></label>
          <input type="text" hidden>
        </div>

        <div class="saisie">
          <label for="ident">Identifiant</label>
          <input type="text" name="ident" id="ident" value="<?= $ident ?>"style="border-color: <?php if (empty($ident) && $submit == "Valider") echo "red"; ?>"; >
        
          <label for="passwd" >Mot de passe</label>
          <input type="password" name="passwd" id="passwd" value="<?= $passwd ?>" style="border-color: <?php if (empty($passwd) && $submit == "Valider") echo "red"; ?>"; >
        </div>

        <div class="saisie">
          <label for="service">Service</label>
          <select name="service" id="service">
            <option value="administratif">Administratif</option>
            <option value="informatique">Informatique</option>
          </select>

          <label for="fonction">Fonction</label>
          <select name="fonction" id="fonction">
            <option value="secretaire">Secrétaire</option>
            <option value="developpeur">Développeur</option>
            <option value="analyste">Analyste</option>
          </select>
        </div>

        <div class="saisie">
          <label for="horaire" >Module Horaire</label>
          <select name="horaire" id="horaire">
            <!-- <option value="0" selected disabled>Choisir...</option> -->
            <option value="5">07:42</option>
            <option value="4">07:36</option>
            <option value="3">07:30</option>
            <option value="2">07:14</option>
            <option value="1">07:00</option>
          </select>
        </div>

        <div class="saisie">
          <div class="bouton">
            <input class="btn btn-primary" type="submit" name="submit" value="Valider"/>
            <input class="btn btn-primary" type="submit" name="submit" value="Effacer">
          </div>
        </div>

      </form>
    </div>

  </div>

<?php
include('./includes/footer.php');
?>