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
                echo "<td>$val</td>";
          }
          ?>
          <tr>
        </tbody>
    </table>
</div>

<?php
  include('./includes/footer.php');
?>