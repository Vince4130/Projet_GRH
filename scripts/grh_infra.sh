#!/bin/bash

#Mise à jour Ubuntu

sudo apt-get update
sudo apt-get upgrade

#fin mise à jour Ubuntu

#
#

#Installation serveur Apache

sudo apt-get install apache2
sudo systemctl enable apache2
sudo systemctl restart apache2

#Fin installation serveur Apache

#
#

#Installation MySQL Server

sudo apt-get install mysql-server
sudo apt-get install mysql-client

#Fin installation MySQL Server

#
#

#Installation PHP et modules Apache et MySQL

sudo apt install php libapache2-mod-php php-mysql

#Fin installation PHP

#
#

#Installation de phpMyAdmin

sudo apt-get install phpmyadmin

#Fin installation phpMyAdmin

#
#

#Installation Git

sudo apt-get install git

#Fin installation Git

#
#

#Installation serveur et client ssh

sudo apt install openssh-client
sudo apt install openssh-server

#Fin installation ssh

#
#

#Generation des cles ssh

ssh-keygen -t rsa

#Fin

#
#

sudo systemctl restart apache2
sudo service mysql restart

#Fin du script