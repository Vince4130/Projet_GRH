<?php
session_start();

require ('./admin/admin_models/modelAdmin_maj_employe.php');

function majEmploye()
{
    
    $id_employe  = $_SESSION['id_employe'];
    $id_fonction = $_SESSION['fonctid'];
    $id_service  = $_SESSION['servid'];
    $id_horaire  = $_SESSION['horid'];
   
    // $erreur = false;
    
    /////////////////////////////////
    //Mise à jour du profil
    ////////////////////////////////
    if (isset($_POST['submit'])) {

        //Récupération des valeurs des variables issues du formulaire sinon valeurs des variables de session lors de la connexion

        $fonction = filter_input(INPUT_POST, 'fonction', FILTER_VALIDATE_INT);
        $service  = filter_input(INPUT_POST, 'service', FILTER_VALIDATE_INT);
        $horaire  = filter_input(INPUT_POST, 'horaire', FILTER_VALIDATE_INT);

        if ($fonction !== $id_fonction OR $service !== $id_service OR $horaire !== $id_horaire) {
            
            $update_employe = updateEmploye($service, $fonction, $horaire, $id_employe);
            
            $update = $update_employe->rowCount();

            if ($update === 1) {
                $erreur      = false;
                $text_erreur = "Le profil de l'employé a été mis à jour";
            } else {
                $erreur      = true;
                $text_erreur = "Une erreur a empéché la mise à jour du profil de l'employé";
            }
        } else {
            $erreur      = true;
            $text_erreur = "Aucune modification du profil";
        }

        $_SESSION['erreur']      = $erreur;
        $_SESSION['text_erreur'] = $text_erreur;

        redirection("index.php?action=employe"); //&id=$id_employe&erreur=$erreur&text_erreur=$text_erreur
    }
       
}