<?php
@session_start();

if (!isset($_SESSION['ident'])) {
  header('Location: index.php?action=accueil');
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
            <div class="succes" id="succes"><?= $text_erreur ?></div>
              <script>
                  setTimeout('window.location = "index.php?action=profil"', 3000);
              </script>
            <?php }
          }  
      ?>
  </div>

  <h5>Mon profil</h5> <!--id="titres"-->

    <form action="index.php?action=profil" method="post">

      <div class="registration">  
      <!-- Attribut readonly pour les champs non modifiables : nom prenom, anciennete, service, fonction et horaire -->
        <div class="civilite">
          <label for="nom">Nom</label>
          <input type="text" name="nom" readonly id="nom" style="background-color: #e9ecef" value="<?= $employe['nom'] ?>" />

          <label for="prenom">Prénom(s)</label>
          <input type="text" name="prenom" readonly id="prenom" style="background-color: #e9ecef" value="<?= $employe['prenom'] ?>" />

          <label for="mail">Email</label>
          <input type="email" name="mail" id="mail" value="<?= $employe['email'] ?>" />
        </div>

        <div class="civilite">
          <label for="ident">Identifiant</label>
          <input type="text" name="ident" id="ident" value="<?= $employe['ident'] ?>" />

          <label for="passwrd">Mot de passe</label>
          <input type="password" name="passwrd" id="passwrd" value="<?= $employe['mdpass'] ?>" />

          <label for="anciennete">Ancienneté</label>
          <input type="text" name="anciennete" readonly id="anciennete" style="background-color: #e9ecef" value="<?= $anciennete_employe ?>" />
        </div>

        <div class="civilite">
          <label for="service">Service</label>
            <input type="text" name="service" readonly id="service" style="background-color: #e9ecef" value="<?= $service_empl ?>" />

            <label for="fonction">Fonction</label>
            <input type="text" name="fonction" readonly id="fonction" style="background-color: #e9ecef" value="<?= $fonction_empl ?>" />

          <label for="horaire">Horaire</label>
            <input type="text" name="horaire" readonly id="horaire" style="background-color: #e9ecef" value="<?= $horaire_empl ?>" />
            <!-- <select name="horaire" id="horaire">
              <option value="<?= $horaire_empl ?>">Valeur actuelle : <?= $horaire_empl ?></option>
              <option value="07:42">07:42</option>
              <option value="07:36">07:36</option>
              <option value="07:30">07:30</option>
              <option value="07:14">07:14</option>
              <option value="07:00">07:00</option>
            </select> -->
        </div>

        <div class="valid">
          <input class="btn btn-primary" type="submit" name="submit" value="Modifier" />
        </div>

      </div>

    </form>
 
  <h6 class="champs">Modifications autorisées : email, identifiant et mot de passe.</h6>
  <h6 class="lien_form">Pour les autres modifications veuillez contacter votre responsable RH</h6>

</div>

<?php
include('./includes/footer.php');
?>