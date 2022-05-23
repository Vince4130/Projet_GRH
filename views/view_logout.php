<?php
session_start();

if (!isset($_SESSION['ident'])) {
  header('Location: index.php?action=accueil');
  exit();
}

require ('./includes/header.php');

?>

<div class="register"> 
  <div class="bandeau">
    <div class="goodbye" ><h5>Au revoir<?= " ".$_SESSION['prenom']." ".$_SESSION['nom']." " ?>à bientôt !</h5>
    <?php
        $_SESSION = array();
        session_destroy();
    ?>
    <script>
             setTimeout('window.location = "index.php?action=accueil"', 3000);
    </script>
    </div>
  </div>
</div>

<?php
require ('./includes/footer.php');
?>