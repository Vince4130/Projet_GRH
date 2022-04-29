<?php

session_start();

include('./includes/header_admin.php');

// if (!isset($_SESSION['adminid'])) {
//     redirection('../../index.php?action=accueil');
// }

// $date = dateFrench($today);

?>

<div class="register">

  <h5>Employé</h5>
  
    <table class="tableau">
      <thead style="border-bottom-color: black">
          <tr>
            <?php 
              $titres = array_keys($detail_empl);
              foreach($titres as $key) { 
              echo "<th>$key</th>";
            }
            ?>
          </tr>
        </thead>
        <tbody> 
          <tr>
            <?php foreach($detail_empl as $key => $val)  { 
                
                if($key == 'Ancienneté') { 
                  if($val < 12) {
                    $mois = $val;
                    $anciennete = $mois." mois";
                  }  
                  if($val >= 12) {
                      $an   = floor($val/12);
                      $mois = $val%12;
                      if($an == 1) {
                        if($mois > 0) {
                          $anciennete = $an." an et ".$mois." mois";
                        } else {
                          $anciennete = $an." an";
                        }
                      } else {
                        if($mois > 0) {
                          $anciennete = $an." ans et ".$mois." mois";
                        } else {
                          $anciennete = $an." ans";
                        }
                      }
                  }                 
                  echo "<td>$anciennete</td>";
                } else {
                  echo "<td>$val</td>";
                }
              }
          ?>
          <tr>
        </tbody>
    </table>
</div>

<?php
  include('./includes/footer.php');
?>