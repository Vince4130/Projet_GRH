<?php
session_start();
?>

<div class="modal fade" id="aurevoir" tabindex="-1"  aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Au revoir</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <p><?= $_SESSION['prenom']." ".$_SESSION['nom'] ?></p>
          </div>
          <form action="index.php?action=logout" method="post">
          <div class="modal-footer">
            <input type="button" class="btn btn-primary" data-bs-dismiss="modal" value="Retour" />
            <input type="submit" class="btn btn-primary" name="submit" value="Valider" />
            <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button> -->
          </div>
          </form>
        </div>
    </div>
</div>