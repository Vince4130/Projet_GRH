<?php
session_start();

if (!isset($_SESSION['adminIdent'])) {
   header('Location: index.php?action=accueil');
   exit();
}

include('./includes/header.php');

$date = dateFrench($today);

?>

<div class="register">
<h5>Tableau de bord RH <?= $date ?></h5>
  <h5>Liste des employés</h5>
  <div class="defile">
    <table class="tableau">

      <thead style="border-bottom-color: black">
          <tr class="trthead">
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
          echo "</tr>";
        ?> 
      </tbody>
    </table>
  </div>
</div>

<?php
include('./includes/footer.php');
?>