<?php
session_start();

require ('./admin/admin_models/modelAdmin_maj_employe.php');

function majEmploye()
{
    
    $id_employe  = (int)$_SESSION['id_employe'];
    $id_fonction = $_SESSION['fonctid'];
    $id_service  = $_SESSION['servid'];
    $id_horaire  = $_SESSION['horid'];
   
    // $erreur = false;
    
    /////////////////////////////////
    //Mise à jour du profil
    ////////////////////////////////
    if (isset($_POST['submit'])) {

        //Récupération des valeurs des variables issues du formulaire sinon valeurs des variables de session lors de la connexion
        if(isset($_POST['service']) && $_POST['service'] != $_SESSION['servid'] ){
            $servid  = (int)$_POST['service'];
        } else {
            $servid = $_SESSION['servid'];
        }

        if(isset($_POST['fonction']) && $_POST['fonction'] != $_SESSION['fonctid'] ){
            $fonctid = (int)$_POST['fonction'];
        } else {
            $fonctid = $_SESSION['fonctid'];
        }
        
        if(isset($_POST['horaire']) && $_POST['horaire'] != $_SESSION['horid'] ){
            $horid   = (int)$_POST['horaire'];
        } else {
            $horid = $_SESSION['horid'];
        }
        
        //Requête de mise à jour du profil de l'employe
        $update_employe = updateEmploye($servid, $fonctid, $horid, $id_employe); //$horaire, 
       
        
        redirection("index.php?action=employe&id=$id_employe&erreur=$erreur&text_erreur=$text_erreur");
    
    }
    
    /////////////////////////////////
    //Mise à jour du profil
    ////////////////////////////////
    // if (isset($_POST['submit'])) {

    //     //Récupération des valeurs des variables issues du formulaire sinon valeurs des variables de session lors de la connexion
    //     $servid  = (int)$_POST['service'];
    //     $fonctid = (int)$_POST['fonction'];
    //     $horid   = (int)$_POST['horaire'];
        
    //     //Requête de mise à jour du profil de l'employe
    //     $update_employe = updateEmploye($servid, $fonctid, $horid, $id_employe); //$horaire, 
    //     // var_dump($update_employe); die;
    //     if ($update_employe !== 1) {
    //         $erreur = true;
    //         $text_erreur  = "Pas de mise à jour";
    //     } else {
    //         $erreur = false;
    //         $text_erreur  = "Mise à jour du profil de l'employé";
    //     }
    //     // header("Location: index.php?action=employe&id=$id_employe");
    // }

    
       
}