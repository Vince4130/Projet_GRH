<?php
session_start();

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
                    <div class="succes" id="succes"><?php afficheDecompteSecondes($text_erreur, 3) ?></div>
                    <script>
                      setTimeout('window.location = "index.php?action=employe&id=<?= $_SESSION['empid'] ?>"', 3000);
                    </script>
                <?php }
        }  
      ?>
  </div>

  <h5>Rechercher un employé</h5>

    <form action="index.php?action=rechEmploye" method="post"> 

        <div class="rechemploye">  
            <!-- <div class="recherche">
                <label for="empid">Numéro employé</label>
                <input type="text" name="empid" readonly id="empid" value="<?= $detail_empl['empid'] ?>" />
            </div>   -->
            <div class="recherche">
                <label for="nom">Nom</label>
                <input type="text" name="nom" id="nom" value="<?= $nom ?? "" ?>" style="border-color:<?php if(isset($_POST['submit']) && empty($_POST['nom'])) echo 'red' ?>"/>
            </div>
            <div class="recherche">
                <label for="prenom">Prénom</label>
                <input type="text" name="prenom" id="prenom" value="<?= $prenom ?? "" ?>" style="border-color:<?php if(isset($_POST['submit']) && empty($_POST['prenom'])) echo 'red' ?>" />
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