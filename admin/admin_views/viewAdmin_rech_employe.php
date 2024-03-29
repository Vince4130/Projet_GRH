<?php
@session_start();

if (!isset($_SESSION['adminIdent'])) {
    header('Location: index.php?action=accueil');
    exit();
 }

include('./includes/header.php');

?>

<script>   

    /**
     * Script effacer 
     * nom prenom
     * @return void
     */
    function eraseNomPrenom(nom, prenom) {
       document.getElementById(nom).value = "";
       document.getElementById(prenom).value = "";
       document.getElementById(nom).style.borderColor = "lightgrey";
       document.getElementById(prenom).style.borderColor = "lightgrey";
    }
    
</script>

<div class="register">

  <div class="bandeau"> 
      <?php if (isset($_POST ['submit'])) {
          if ($erreur) { ?>
            <div class="echec" id="echec"><?= $text_erreur ?>
                <button type="button" class="croix" onclick="cacheDiv('echec')">x</button> 
            </div>

          <?php } 
                else { ?>
                    <div class="succes" id="succes"><?php afficheDecompteSecondes($text_erreur, 2) ?></div>
                    <?php if ($rows == 1) : ?>
                    <script>
                      setTimeout('window.location = "index.php?action=employe&id=<?= $_SESSION['empid'] ?>"', 2000);
                    </script>
                <?php endif; 
                    if ($rows > 1) : ?>
                        <script>
                            setTimeout('window.location = "index.php?action=resultRechEmploye"', 2000);
                        </script>
                    <?php endif; }
        }  
      ?>
  </div>

  <h5>Rechercher un employé&nbsp;<span>*</span></h5>

    <form action="index.php?action=rechEmploye" method="post"> 

        <div class="rechemploye">  
            <!-- <div class="recherche">
                <label for="empid">Numéro employé</label>
                <input type="text" name="empid" readonly id="empid" value="<?= $detail_empl['empid'] ?>" />
            </div>   -->
            <div class="recherche">
                <label for="nom">Nom</label>
                <input type="text" name="nom" id="nom" value="<?= $nom ?? "" ?>" style="border-color:<?php if(isset($_POST['submit']) && (empty($_POST['nom']) OR (empty($nom)))) echo 'red' ?>"/>
            </div>
            <div class="recherche">
                <label for="prenom">Prénom</label>
                <input type="text" name="prenom" id="prenom" value="<?= $prenom ?? "" ?>" style="border-color:<?php if(isset($_POST['submit']) && (empty($_POST['prenom']) OR (empty($prenom)))) echo 'red' ?>" />
            </div>

            <div class="valid">
                <input class="btn btn-primary" type="submit" name="submit" value="Valider" />
                <input class="btn btn-primary" onclick="eraseNomPrenom('nom', 'prenom')" value="Effacer" /> 
            </div>
        </div>

    </form>
    <h6 class="champs"><span>*&nbsp;</span>Recherche sur le nom et/ou le prénom</h6>
</div>

<?php
include('./includes/footer.php');
?>