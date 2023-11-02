<?php

$visites = "./fichiers/compteur.txt";

if (!file_exists($visites)) {
    touch($visites);
    $nb_visites = 0;
    $id_file = fopen($visites, "w");
    fwrite($id_file, $nb_visites);
    fclose($id_file);

} else {
    
    $id_file = fopen($visites, "r");
    $nb_visites = fgets($id_file);
    $nb_visites = intval($nb_visites) + 1;
    fclose($id_file);
    
    $id_file = fopen($visites, "w"); 
    fwrite($id_file, $nb_visites);
    fclose($id_file); 
}

echo $nb_visites;

?>