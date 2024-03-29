<?php
@session_start();

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

        <label for="horaire">Module horaire</label>
        <select name="horaire" id="horaire">
            <option value="<?= $detail_empl['horid'] ?>"><?= $horaire['Mod_Hor']." (actuel)" ?></option>
            <?php  
                foreach($horaires as $horaire) { ?>
                  <option value="<?= $horaire['horid']?>" style="display:<?= ($detail_empl['horid'] ==  $horaire['horid']) ?  'none' : 'block' ?>">
                    <?= $horaire['horaire'] ?>
                  </option>
              <?php } ?>
        </select>
      </div>

      <div class="civilite">
        <label for="conges">Solde jours de congés</label>
        <input type="text" name="conges" readonly id="conges" style="background-color: #e9ecef" value="<?= $solde_conges['jours'] ?>" />

        <label for="formation">Solde jours de Formation</label>
        <input type="text" name="formation" readonly id="formation" style="background-color: #e9ecef" value="<?= $solde_formation['jours'] ?>" />

        <label for="formation">Solde jours de Télétravail</label>
        <input type="text" name="teletravail" readonly id="teletravail" style="background-color: #e9ecef" value="<?= $solde_teletravail['jours'] ?>" />
      </div>

      <div class="civilite">
          <label for="service">Service</label>
          <select name="service" id="service" onchange="myService()">
            <option value="<?= $detail_empl['servid'] ?>"><?= $detail_empl['service']." (actuel)" ?></option>
             <?php
                foreach($services as $service) { ?>
                  <option value="<?= $service['servid'] ?>" style="display:<?= ($detail_empl['servid'] == $service['servid']) ? "none" : "block" ?>"><?= $service['libelle'] ?></option>
              <?php } ?>
          </select>

          <label for="fonction">Fonction</label>

          <?php for($i=0; $i < count($listeLibServices); $i++) : 
              
              if($listeLibServices[$i] == "Administratif") : ?>

                <select name="fonction" id="admin">
                  <option value="" disabled selected>
                    <?= ($detail_empl['servid'] == 1) ? $detail_empl['fonction']." (actuelle)" : "Veuillez choisir une fonction" ?>
                  </option>
                  <?php  
                    foreach($fonctionsAd as $fonctionAd) { ?>
                      <option value="<?= $fonctionAd['fonctid']?>">
                        <?= $fonctionAd['libelle'] ?>
                      </option>
                  <?php } ?>
                </select>

              <?php elseif($listeLibServices[$i] == "Informatique") : ?>
                <select name="fonction" id="info">
                  <option value="" disabled selected>
                    <?= ($detail_empl['servid'] == 2) ? $detail_empl['fonction']." (actuelle)" : "Veuillez choisir une fonction" ?>
                  </option>
                  <?php  
                    foreach($fonctionsInfo as $fonctionInfo) { ?>
                      <option value="<?= $fonctionInfo['fonctid']?>">
                        <?= $fonctionInfo['libelle'] ?>
                      </option>
                  <?php } ?>
                </select>
                
              <?php endif; 
            endfor;?>
             
          <label for="anciennete">Ancienneté</label>
          <input type="text" name="anciennete" readonly id="anciennete" style="background-color: #e9ecef" value="<?= $anciennete_employe ?>" />
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