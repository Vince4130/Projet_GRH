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
          if ($erreur) { ?>
            <div class="echec" id="echec"><?= $text_erreur ?>
                <button type="button" class="croix" onclick="cacheDiv('echec')">x</button> 
            </div>

          <?php } 
                else { ?>
                    <div class="succes" id="succes"><?= $text_erreur ?></div>
                    <script>
                      // setTimeout('window.location = "index.php?action=employe&id=<?= $_SESSION['id_employe'] ?>"', 2000);
                      setTimeout('window.location = "index.php?action=listeEmployes"', 2000);
                    </script>
                <?php }
        }  
      ?>
  </div>

  <h5>Profil employé</h5>

  <form action="index.php?action=employe&id=<?= $id ?? $_SESSION['id_employe'] ?>" method="post"> 

    <div class="profilemploye">  
    <!-- Attribut readonly pour les champs non modifiables : id, nom, prenom, email, congés, formation, anciennete -->
      <div class="civilite">
        <label for="empid">Numéro employé</label>
        <input type="text" name="empid" readonly id="empid" style="background-color: #e9ecef" value="<?= $detail_empl['empid'] ?>" />

        <label for="nom">Nom</label>
        <input type="text" name="nom" readonly id="nom" style="background-color: #e9ecef" value="<?= $detail_empl['nom'] ?>" />

        <label for="prenom">Prénom</label>
        <input type="text" name="prenom" readonly id="prenom" style="background-color: #e9ecef" value="<?= $detail_empl['prenom'] ?>"  />
      </div>

      <div class="civilite">
        <label for="ident">Identifiant</label>
        <input type="text" name="ident" readonly id="ident" style="background-color: #e9ecef" value="<?= $detail_empl['ident'] ?>" />

        <!-- <label for="passwrd">Mot de passe</label>
        <input type="password" name="passwrd" id="passwrd" value="<?= $detail_empl['mdpass'] ?>" /> -->

        <label for="mail">Email</label>
        <input type="email" name="mail" readonly id="mail" style="background-color: #e9ecef" value="<?= $detail_empl['email'] ?>" />
      </div>

      <div class="civilite">
        <label for="conges">Solde jours de congés</label>
        <input type="text" name="conges" readonly id="conges" style="background-color: #e9ecef" value="<?= $solde_conges['jours'] ?>" />

        <label for="formation">Solde jours de Formation</label>
        <input type="text" name="formation" readonly id="formation" style="background-color: #e9ecef" value="<?= $solde_formation['jours'] ?>" />

        <label for="horaire">Module horaire</label>
        <select name="horaire" id="horaire">
            <option value="<?= $detail_empl['horid'] ?>"><?= $horaire['Mod_Hor']." (actuel)" ?></option>
            <option value="5">07:42</option>
            <option value="4">07:36</option>
            <option value="3">07:30</option>
            <option value="2">07:14</option>
            <option value="1">07:00</option>
        </select>
      </div>

      <div class="civilite">
          <label for="service">Service</label>
          <select name="service" id="service">
            <option value="<?= $detail_empl['servid'] ?>"><?= $detail_empl['service']." (actuel)" ?></option>
              <?php for($i = 0; $i < count($services); $i++ ) : ?>
                  <option value="<?= 
                    $services[$i]['servid']?>"><?= $services[$i]['libelle'] ?></option>
              <?php endfor; ?>
          </select>

          <label for="fonction">Fonction</label>
          <select name="fonction" id="fonction">
              <option value="<?= $detail_empl['fonctid'] ?>"><?= $detail_empl['fonction']." (actuelle)" ?></option>
              <?php for($i = 0; $i < count($fonctions); $i++ ) : ?>
                  <option value="<?= $fonctions[$i]['fonctid']?>"><?= $fonctions[$i]['libelle'] ?></option>
              <?php endfor; ?>
            </select>

          <label for="anciennete">Ancienneté</label>
          <input type="text" name="anciennete" readonly id="anciennete" style="background-color: #e9ecef" value="<?= $anciennete ?>" />
      </div>

      <div class="valid">
        <input class="btn btn-primary" type="submit" name="submit" value="Modifier" />
        <input class="btn btn-primary" type="submit" name="submit" value="Retour" />
      </div>

    </div>

  </form>
  <h6 class="champs">Modifications autorisées : module horaire, service et fonction.</h6>
</div>

<?php
  include('./includes/footer.php');
?>