<?php

session_start();

include('./includes/header_2.php');

if (!isset($_SESSION['ident'])) {
    redirection('index.php?action=accueil');
}

$date = dateFrench($today);

?>

<!-- <?= $_SESSION['horaire']; ?> -->

<div class="register">

<h5>Formulaire</h5>
  <div class="formulaire">
    <form  action="index.php?action=formulaire" method="POST">

      <div class="saisie">

        <label for="motif">Votre demande concerne</label>
        <select name="motif" id="motif">
          <option value="profil">Modification profil</option>
          <option value="horaire">Modification horaire</option>
        </select>
              
        <label for="message">Saisir votre message</label>
        <textarea class="form-control" name="message" id="message" rows="3"></textarea>

        <!-- <label for="fichier">Envoyer une pièce jointe</label> -->
        <!-- <input type="file" class="form-control" name="fichier" id="fichier"> -->
        <!-- <div class="input-group">
          <input type="text" class="form-control input-file-dummy" placeholder="Choisir un fichier" aria-describedby="fileHelp" required>
          <div class="valid-feedback order-last">File is valid</div>
          <div class="invalid-feedback order-last">File is required</div>
          <label class="input-group-append mb-0">
            <span class="btn btn-primary input-file-btn">
              Parcourir… <input type="file" hidden>
            </span>
          </label>
        </div> -->

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