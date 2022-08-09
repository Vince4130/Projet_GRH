<?php
session_start();

if (!isset($_SESSION['ident'])) {
    header('Location: index.php?action=accueil');
    exit();
}

include('./includes/header.php');

$date = dateFrench($today);

?>

<div class="register">
  <div class="welcome">
    <h5>Bonjour&nbsp;<?= $_SESSION['prenom']." ".$_SESSION['nom'] ?></h5>
    <h5>Situation au <?= $date ?></h5>
      <table>
        <tbody class="tableauW">
          <tr>
            <td>Crédit/débit heure :</td>
            <td class="tdW"><?= isset($format_cumul) ? $format_cumul : "00:00" ?></td>
          </tr>
          <?php foreach($tababsences as $absences) : 

              if($absences['libelle'] == "Congés") : ?>
                <tr>
                  <td>Solde jours de congés : </td>
                  <td class="tdW"><?= $absences['nbjours'] ?></td>
                </tr>           
              <?php endif; 
              
              if($absences['libelle'] == "Formation") : ?>
                <tr>
                  <td>Solde jours de formation :</td>
                  <td class="tdW"><?= $absences['nbjours'] ?></td>
                </tr>
              <?php endif;
          endforeach; ?>
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