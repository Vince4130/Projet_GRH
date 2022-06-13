<?php
session_start();
?>

<div class="modal fade" id="suppRH" tabindex="-1"  aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Supression RH</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <p>Voulez-vous supprimer le responsable ?</p>
            <p id="nomRH"></p>
          </div>
          <form action="index.php?action=listeRH" method="post">
            <div class="modal-footer">
              <input type="text" hidden name="empid" value="<?= $_SESSION['adminid'] ?>" />
              <input type="button" class="btn btn-primary" data-bs-dismiss="modal" value="Retour" />
              <input type="submit" class="btn btn-primary" name="submit" value="Valider" />
              <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary">Save changes</button> -->
            </div>
          </form>
        </div>
    </div>
</div>