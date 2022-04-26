<?php

session_start();

include('./includes/header_2.php');

if (!isset($_SESSION['ident'])) {
    redirection('view_accueil.php');
}

$date = dateFrench($today);

?>

<!-- <?= $_SESSION['horaire']; ?> -->

<div class="register">

  <h5>Bonjour&nbsp;<?= $_SESSION['prenom']." ".$_SESSION['nom'] ?></h5>
  <h5>Situation au <?= $date ?></h5>
  
  <div class="welcome">
    <table>
      <tbody class="tableauW">
        <tr>
          <td>Crédit/débit heure :</td>
          <td class="tdW"><?= $format_cumul ?></td>
        </tr>
        <tr>
          <td>Solde jours de congés : </td>
          <td class="tdW">52</td>
        </tr>
        <tr>
          <td>Nombre de jour de formation :</td>
          <td class="tdW">10</td>
        </tr>
        <!-- <tr>
          <td>Nombre de jour d'arrêt maladie :</td>
          <td class="tdW">0</td>
        </tr> -->
      </tbody>
    </table>
  </div>
</div>

<?php
  include('./includes/footer.php');
?>