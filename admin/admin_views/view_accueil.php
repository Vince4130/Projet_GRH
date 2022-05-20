<?php

session_start();

include('./includes/header.php');

if (!isset($_SESSION['adminid'])) {
    redirection('../../index.php?action=accueil');
}

$date = dateFrench($today);

?>

<div class="register">
<h5>Tableau de bord RH <?= $date ?></h5>
  <h5>Liste des employés</h5>
  
    <table class="tableau">

      <thead style="border-bottom-color: black">
          <tr>
              <th>Nom</th>
              <th>Prénom</th>
              <th>Date embauche</th>
          </tr>
        </thead>

        <tbody> 
        <?php
          while($employe = $listEmployes->fetch(PDO::FETCH_ASSOC)) { 
            $id =  $employe['empid'];     
            echo "<tr>";
              echo "<td><a href=index.php?action=employe&id=$id>".$employe['nom']."</a></td>";
              echo "<td>".$employe['prenom']."</td>";

            if(($employe['dateEmbauche']) != NULL) {
              echo "<td>".date('d/m/Y',strtotime($employe['dateEmbauche']))."</td>"; 
            } 
            else {
              echo "<td>Non renseignée</td>";
            }         
          }  
          echo "<tr>";
        ?> 
        </tbody>
        
    </table>
</div>

<?php
  include('./includes/footer.php');
?>