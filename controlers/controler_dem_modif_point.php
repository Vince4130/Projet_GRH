<?php

require ('./models/model_dem_modif_point.php');

function demModifPoint()   //formulaire
{
    
    if(isset($_GET['point_id'])) {

        $point_id = (int)($_GET['point_id']);
        
        $req_pointage = getPointage($point_id);

        $pointage = $req_pointage->fetch(PDO::FETCH_ASSOC);
    }
    
   
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
                
                //Récupération du pointage initial
                $req_pointage = getPointage($id);

                $pointage = $req_pointage->fetch(PDO::FETCH_ASSOC);

                $ha_init  = $pointage['ha'];
                $hd_init  = $pointage['hd'];
                $pm1_init = $pointage['pm1'];
                $pm2_init = $pointage['pm2'];
                
                if (!empty($ha) && !empty($hd) && !empty($pm1) && !empty($pm2)) {
                    //Vérification existence d'une modification sur ce pointage
                    $req_exist_modif = existModifPointage($id);

                    $exist = $req_exist_modif->fetch(PDO::FETCH_ASSOC);

                    if(!$exist) {

                        //Vérification si horaires postées différents du pointage initial
                        if ($ha == $ha_init && $hd == $hd_init && $pm1 == $pm1_init && $pm2 == $pm2_init) {
                            $erreur = true;
                            $text_erreur = "Aucune modification";
                        } else {

                            //Requête de demande de modification de pointage
                            $modif_pointage = demandeModifPointage($date, $ha, $pm1, $pm2, $hd, $id);
                            // var_dump($modif_pointage); die;
                                if ($modif_pointage == false) {
                                    $erreur      = true;
                                    $text_erreur = "Votre demande de modification de pointage n'est pas enregistrée";
                                    
                                } else {
                                    $erreur      = false;
                                    $text_erreur = "Votre demande de modification de pointage est enregistrée";
                                    
                                }
                        }
                    }
                } else {
                    $erreur      = true;
                    $text_erreur = "Veuillez compléter tous les champs";
                } 
                
            break;

            case "Retour" :
                header('Location: index.php?action=histo_point');
                exit();
            break;        
            
        }

    }

    require('./views/view_dem_modif_point.php');
}