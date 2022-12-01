<?php
@session_start();

include('./includes/header.php');

?>

<div class="register">

  <div class="bandeau">

    <?php if (isset($_POST ['submit']) && $_POST['submit'] == "Valider") {     
      
      if ($exist) { ?>     
        <div class="echec" id="echec"><?= $text_erreur; ?>
            <button type="button" class="croix" onclick="cacheDiv('echec')">x</button>
        </div>

      <?php }         
            else { 
                if ($erreur) { ?>
                  <div class="echec" id="echec"><?= $text_erreur; ?>
                        <button type="button" class="croix" onclick="cacheDiv('echec')">x</button>
                  </div>
                <?php } else { ?>
                          <div class="succes" id="succes"><?php afficheDecompteSecondes($text_erreur, 3); ?></div>
                          <script>setTimeout('window.location = "index.php?action=connect"', 3000);</script>
                <?php  }
            }
      } 
      ?>
  </div>

  <h5>S'enregistrer</h5>
  
      <form  action="index.php?action=registration" method="POST">
        
        <div class="registration">

          <div class="civilite">
            <label for="nom">Nom</label>
            <input type="text" name="nom" id="nom" value="<?= isset($_POST['nom']) ? $_POST['nom'] : "" ?>" style="border-color: <?php if (empty($_POST['nom']) && $submit == "Valider") echo "red"; ?>"; >

            <label for="prenom">Prénom(s)</label>
            <input type="text" name="prenom" id="prenom" value="<?= isset($_POST['prenom']) ? $_POST['prenom'] : "" ?>" style="border-color: <?php if (empty($_POST['prenom']) && $submit == "Valider") echo "red"; ?>"; >
          
            <label for="mail">Email</label>
            <input type="email" name="mail" id="mail" placeholder="email@exemple.com" value="<?= isset($_POST['mail']) ? $_POST['mail'] : "" ?>" style="border-color: <?php if (empty($_POST['mail']) && $submit == "Valider") echo "red"; ?>"; >
          </div>

          <div class="civilite">
            <label for="ident">Identifiant</label>
            <input type="text" name="ident" id="ident" value="<?= isset($_POST['ident']) ? $_POST['ident'] : "" ?>" style="border-color: <?php if (empty($_POST['ident']) && $submit == "Valider") echo "red"; ?>"; >
          
            <label for="passwd" >Mot de passe</label>
            <input type="password" name="passwd" id="passwd" value="<?= isset($_POST['passwd']) ? $_POST['passwd'] : "" ?>" style="border-color: <?php if (empty($_POST['passwd']) && $submit == "Valider") echo "red"; ?>"; >

            <label for="credit_ant" >Crédit Heure ?&nbsp;<span>*</span></label>
            <input type="time" name="credit_ant" id="credit_ant" value="<?= isset($_POST['credit_ant']) ? $_POST['credit_ant'] : "" ?>" >
          </div>

          <div class="civilite">
            <label for="service">Service</label>
            <select name="service" id="service" style="border-color: <?php if (empty($_POST['service']) && $submit == "Valider") echo "red"; ?>"; onchange="myService()" >
              <option value="0" selected="true" disabled="disabled">Veuillez choisir un service</option>
              <?php
                foreach($services as $service) { ?>
                <option value="<?= $service['servid'] ?>"  <?= (isset($_POST['service']) && $_POST['service'] == $service['servid']) ? "selected" : "" ?>><?= $service['libelle'] ?></option>
              <?php } ?>
            </select>
            
            <label>Fonction</label>
            <select name="fonction" id="vide" style="border-color: <?php if (empty($_POST['fonction']) && $submit == "Valider") echo "red"; ?>"; >
              <option value="" selected="true" disabled="disabled">Veuillez choisir une fonction</option>
            </select>
            
            <select name="fonction" id="admin" style="border-color: <?php if (empty($_POST['fonction']) && $submit == "Valider") echo "red"; ?>"; >
              <option value="" selected="true" disabled="disabled">Veuillez choisir une fonction</option>
              <?php  
                foreach($fonctionsAd as $fonctionAd) { ?>
                  <option value="<?= $fonctionAd['fonctid']?>" <?= (isset($_POST['fonction']) && $_POST['fonction'] == $fonctionAd['fonctid']) ? "selected" : "" ?>><?= $fonctionAd['libelle'] ?></option>
              <?php } ?>
            </select>

            <select name="fonction" id="info" style="border-color: <?php if (empty($_POST['fonction']) && $submit == "Valider") echo "red"; ?>"; >
                <option value="" selected="true" disabled="disabled">Veuillez choisir une fonction</option>
              <?php  
                foreach($fonctionsInfo as $fonctionInfo) { ?>
                  <option value="<?= $fonctionInfo['fonctid']?>" <?= (isset($_POST['fonction']) && $_POST['fonction'] == $fonctionInfo['fonctid']) ? "selected" : "" ?>><?= $fonctionInfo['libelle'] ?></option>
              <?php } ?>
            </select>
            
            <label for="horaire" >Module Horaire</label>
            <select name="horaire" id="horaire" style="border-color: <?php if (empty($_POST['horaire']) && $submit == "Valider") echo "red"; ?>"; >
              <option value="" selected="true" disabled="disabled">Veuillez choisir un horaire</option>
              <?php  
                foreach($horaires as $horaire) { ?>
                  <option value="<?= $horaire['horid']?>" <?= (isset($_POST['horaire']) && $_POST['horaire'] == $horaire['horid']) ? "selected" : "" ?>><?= $horaire['horaire'] ?></option>
              <?php } ?>
            </select>
          </div>
          
          <div class="valid">
            <input class="btn btn-primary" type="submit" name="submit" value="Valider" />
            <input class="btn btn-primary" type="submit" name="submit" value="Effacer" /> 
          </div>
          
        </div>

      </form>
  
      <h6 class="champs"><span>*&nbsp;</span>A compléter uniquement si vous disposez d'un crédit d'heure</h6>
      
</div>

<?php
include('./includes/footer.php');
?>