<?php
session_start();

include('./includes/header.php');

?>

<div class="register">

  <div class="bandeau">

    <?php if (isset($_POST ['submit']) && $_POST['submit'] == "Valider") {     
      
      if ($exist) { ?>     
        <div class="echec" id="echec"><?= $text_erreur; ?>
            <button type="button" class="croix" onclick="cacheDiv(echec)">x</button>
        </div>

      <?php }         
            else { 
                if ($erreur) { ?>
                  <div class="echec" id="echec"><?= $text_erreur ?>
                        <button type="button" class="croix" onclick="cacheDiv(echec)">x</button>
                  </div>

                <?php 
                } 
                else { ?>
                          <div class="succes" id="succes"><?= $text_erreur ?></div>

                          <script>setTimeout('window.location = "index.php?action=adminAccueil"', 3000);</script>
                <?php  }
            }
      } 
      ?>
  </div>

  <h5>Enregistrer un employé</h5>
  
      <form  action="index.php?action=creerEmploye" method="POST">
        
        <div class="registration">

          <div class="civilite">
            <label for="nom">Nom</label>
            <input type="text" name="nom" id="nom" value="<?= $nom ?>" style="border-color: <?php if (empty($nom) && $submit == "Valider") echo "red"; ?>"; >

            <label for="prenom">Prénom</label>
            <input type="text" name="prenom" id="prenom" value="<?= $prenom ?>" style="border-color: <?php if (empty($prenom) && $submit == "Valider") echo "red"; ?>"; >
          
            <label for="mail">Email</label>
            <input type="text" name="mail" id="mail" placeholder="email@exemple.com" value="<?= $mail ?>" style="border-color: <?php if (empty($mail) && $submit == "Valider") echo "red"; ?>"; >
            <label for=""></label>
            <input type="text" hidden>
          </div>

          <div class="civilite">
            <label for="ident">Identifiant</label>
            <input type="text" name="ident" id="ident" value="<?= $ident ?>"style="border-color: <?php if (empty($ident) && $submit == "Valider") echo "red"; ?>"; >
          
            <label for="passwd" >Mot de passe</label>
            <input type="password" name="passwd" id="passwd" value="<?= $passwd ?>" style="border-color: <?php if (empty($passwd) && $submit == "Valider") echo "red"; ?>"; >
          </div>

          <div class="civilite">
            <label for="service">Service</label>
            <select name="service" id="service">
              <option value=1>Administratif</option>
              <option value=2>Informatique</option>
            </select>

            <label for="fonction">Fonction</label>
            <select name="fonction" id="fonction">
              <?php 
              for($i = 0; $i < count($fonctions); $i++ ) { ?>
              <option value="<?= $fonctions[$i]['fonctid']?>"><?= $fonctions[$i]['libelle'] ?></option>
              <?php } ?>
            </select>
        
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
          
          <div class="valid">
            <input class="btn btn-primary" type="submit" name="submit" value="Valider"/>
           <input class="btn btn-primary" type="submit"  onclick="erase()" value="Effacer"> <!--name="submit" -->
          </div>
          
        </div>

      </form>

</div>

<?php
include('./includes/footer.php');
?>