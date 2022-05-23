<?php

function demModifPoint()   //formulaire
{
    
    $point_id = (int)($_GET['point_id']);
    
    $req_pointage = getPointage($point_id);

    $pointage = $req_pointage->fetch(PDO::FETCH_ASSOC);

    if (isset($_POST['submit'])) {

        $action = $_POST['submit'];
        
        switch($action) {

            case "Valider" :
                
                //Récupération des valeurs des variables issues du formulaire
                $ha   = $_POST['ha'];
                $hd   = $_POST['hd'];
                $pm1  = $_POST['pm1'];
                $pm2  = $_POST['pm2'];
                $date = $_POST['date'];
                $id   = (int)($_POST['point_id']);

                //Vérification existence d'une modification sur ce pointage
                $req_exist_modif = existModifPointage($id);
                
                $exist = $req_exist_modif->fetch(PDO::FETCH_ASSOC);
                
                if(!$exist) {

                     //Requête de demande de modification de pointage
                    $modif_pointage = demandeModifPointage($date, $ha, $pm1, $pm2, $hd, $id);
                    // var_dump($modif_pointage); die;
                    if ($modif_pointage != 1) {
                        $text_erreur = "Votre demande de modification de pointage n'est pas enregistrée";
                        $erreur = true;
                        
                    } else {
                        $text_erreur = "Votre demande de modification de pointage est enregistrée";
                        $erreur = false;
                    }
                } 
                // else {
                //     $text_erreur = "Une demande de modification est en attente sur ce pointage";
                //     $erreur = true;
                // }
               
            break;

            case "Retour" :
                redirection('index.php?action=histo_point');
            break;        
          // $bdd = NULL;
        }

    }

    require('./views/view_dem_modif_point.php');
}