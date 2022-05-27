<?php
session_start();

if (!isset($_SESSION['adminIdent'])) {
  header('Location: index.php?action=accueil');
  exit();
}

include('./includes/header.php');

?>

<div class="register">

  <div class="bandeau"> 
      <?php if (isset($_POST ['submit'])) {
          
          if ($echec) { ?>
            <div class="echec" id="echec"><?php echo $text; ?>
                <button type="button" class="croix" onclick="cacheDiv()">x</button>
            </div>

          <?php } 
                else { ?>
                    <div class="succes" id="succes"><?php echo $text; ?></div>
                    <script>
                      setTimeout('window.location = "index.php?action=adminAcceuil"', 3000);
                    </script>
                <?php }
        }  
      ?>
    </div>

  <h5>Profil employé</h5>

  <form action="" method="post">

    <div class="profilemploye">  
    <!-- Attribut readonly pour les champs non modifiables : id, nom, prenom, email, congés, formation, anciennete -->
      <div class="civilite">
        <label for="empid">Numéro employé</label>
        <input type="text" name="empid" readonly id="empid" value="<?= $detail_empl['empid'] ?>" />

        <label for="nom">Nom</label>
        <input type="text" name="nom" readonly id="nom" value="<?= $detail_empl['nom'] ?>" />

        <label for="prenom">Prénom</label>
        <input type="text" name="prenom" readonly id="prenom" value="<?= $detail_empl['prenom'] ?>"  />
      </div>

      <div class="civilite">
        <label for="ident">Identifiant</label>
        <input type="text" name="ident" readonly id="ident" value="<?= $detail_empl['ident'] ?>" />

        <!-- <label for="passwrd">Mot de passe</label>
        <input type="password" name="passwrd" id="passwrd" value="<?= $detail_empl['mdpass'] ?>" /> -->

        <label for="mail">Email</label>
        <input type="email" name="mail" readonly id="mail" value="<?= $detail_empl['email'] ?>" />
      </div>

      <div class="civilite">
        <label for="conges">Solde congés</label>
        <input type="text" name="conges" readonly id="conges" value="" />

        <label for="formation">Total jours de Formation</label>
        <input type="text" name="formation" readonly id="formation" value="" />

        <label for="horaire">Module horaire</label>
        <select name="horaire" id="horaire">
            <option value="<?= $horaire['Mod_Hor'] ?>"><?= $horaire['Mod_Hor'] ?></option>
            <option value="07:42">07:42</option>
            <option value="07:36">07:36</option>
            <option value="07:30">07:30</option>
            <option value="07:14">07:14</option>
            <option value="07:00">07:00</option>
          </select>
      </div>

      <div class="civilite">
          <label for="service">Service</label>
          <select name="service" id="service">
            <option value="<?= $detail_empl['service'] ?>"><?= $detail_empl['service'] ?></option>
            <option value="1">Administratif</option>
            <option value="2">Informatique</option>
          </select>

          <label for="fonction">Fonction</label>
          <select name="fonction" id="fonction">
              <option value="<?= $detail_empl['fonction'] ?>"><?= $detail_empl['fonction'] ?></option>
              <?php 
              for($i = 0; $i < count($fonctions); $i++ ) { ?>
              <option value="<?= $fonctions[$i]['fonctid']?>"><?= $fonctions[$i]['libelle'] ?></option>
              <?php } ?>
            </select>

          <label for="anciennete">Ancienneté</label>
          <input type="text" name="anciennete" readonly id="anciennete" value="<?= $anciennete ?>" />
      </div>

      <div class="valid">
        <input class="btn btn-primary" type="submit" name="submit" value="Modifier" />
        <input class="btn btn-primary" type="submit" name="submit" value="Retour" />
      </div>

    </div>

  </form>

</div>

<?php
  include('./includes/footer.php');
?>