<?php

require('./models/model_resultats.php');
include_once('./includes/inc_functions.php');

function resultPointage() 
{
    
    $id = $_SESSION['id'];

    $creditHeure = $_SESSION['credit'];

    //Mise en forme du temps réalisé dans la journée
    switch ($creditHeure[0]) {
    case "E":
        $_SESSION['creditRes'] = $_SESSION['credit'];
        break;
    case "-":
        $creditHeure = substr($creditHeure, 1);
        $_SESSION['creditRes'] = "-".gmdate('H:i', timeTosecond($creditHeure));
        break;
    default :
        $_SESSION['creditRes'] = gmdate('H:i', timeTosecond($creditHeure));
    break;
    } 

    if (isset($_POST['submit'])) { 

        $action = $_POST['submit'];

        switch ($action) {

            case "Valider":

                $jour = $_SESSION['date'];
            
                $req_deja_pointe = existPointage($jour, $id);

                if ($req_deja_pointe != 1 ) {

                    $ha = $_SESSION['ha'];
                    $hd = $_SESSION['hd'];
                    $p1 = $_SESSION['p1'];
                    $p2 = $_SESSION['p2'];

                    $req_insert_pointage = insertPointage($jour, $ha, $p1, $p2, $hd, $id);
                                   
                    if ($req_insert_pointage != 1) {
                        $text_erreur = "Votre pointage n'est pas enregistré";
                        $erreur = true;
                        // redirection("register.php");
                    } else {
                        $text_erreur = "Votre pointage est enregistré";
                        $erreur = false;
                    }
                        
                }
                else {
                    $text_erreur = "Pointage du ".formatDate(inverseDate($jour))." déjà validé";
                    $erreur = true ; 
                }
                break;

            case "Retour":
                redirection('index.php?action=pointage');
                break;
        }
    }

    require('./views/view_resultats.php');
}