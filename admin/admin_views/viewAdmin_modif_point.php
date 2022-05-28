<?php
session_start();

if (!isset($_SESSION['adminIdent'])) {
    header('Location: index.php?action=accueil');
    exit();
}
  
require ('./includes/header.php');

?>

<div class="register">
     
    <h5>Demandes de modification de pointages en attente</h5>

    <table class="tableau">
        <thead style="border-bottom-color: black">
            <tr>
                <th>Date demande</th>
                <th>N° Employé</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Date Pointage</th>
                <th>Voir Modification</th>
            </tr>
        
        </thead>

        <tbody>
            <?php if($listModifPoint) {
                for($i = 0; $i < $nblignes; $i++) {

                    echo "<tr>";

                    foreach($listModifPoint[$i] as $key => $val) {
                        
                        if($key == 'id') { ?>

                            <td><button class="btn btn-edit" title="Voir Modification" onclick="location.href='index.php?action=consultModif&dempointid=<?= $val ?>'"><i class="fa fa-edit"></i></button></td>
                    <?php  } 
                        else {
                            echo "<td>$val</td>";
                       }
                    }
                }
                
                echo "</tr>";
            } 
                else {
                    echo "<tr><td colspan='8' style=\"color: white; background-color: dodgerblue; height: 40px;\">Aucune modification en attente</td></tr>";
                }
            
            $req_list_modif_point->closeCursor();
            ?>
            
        </tbody>

    </table>
                        
</div>

<?php
 require('./includes/footer.php');
?>



