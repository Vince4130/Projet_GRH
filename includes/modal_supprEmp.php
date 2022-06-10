<?php
session_start();
?>

<div class="modal fade" id="supp" tabindex="-1"  aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Supression Employé</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <p>Voulez-vous supprimer l'employé</p>
            <p><?= $_SESSION['prenomEmploye']." ".$_SESSION['nomEmploye'] ?></p>
          </div>
          <form action="index.php?action=supprEmploye" method="post">
            <div class="modal-footer">
              <input type="text" hidden name="empid" value="<?= $_SESSION['empid'] ?>" />
              <input type="button" class="btn btn-primary" data-bs-dismiss="modal" value="Retour" />
              <input type="submit" class="btn btn-primary" name="submit" value="Valider" />
              <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary">Save changes</button> -->
            </div>
          </form>
        </div>
    </div>
</div>