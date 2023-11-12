# Projet_GRH
Application GRH projet CNAM UE NFA021

#Gestion des ressources humaines

Fonctionnalités:

    Utilisateurs: Création de compte, modification profil, gestion des pointages (création - modification - historique), gestion des absences (demandes), consultation historique, planning

    Administrateur: Création compte administrateur, création consultation et modification comptes utilisateurs, planning, validation des demandes de modifications de pointage et des demandes d'absences

A paramétrer une fois le projet cloné

Fichier includes/inc_param.php à créer :
<?php

define("HOST", "host_name");
define("USER", "mysql_user_name");
define("PWD", "mysql_user_password");
define("PORT", "mysql_port_number");
define("DBNAME", "grh");

?>

Dossier fichiers à créer à la racine du projet :
mkdir -p fichiers
