#!/bin/bash

# Date de sauvegarde

jour=$(date +%Y-%m-%d)

# Dossier de sauvegarde

backup_dir="backup_grh"

# Creation du repertoire

mkdir -p $backup_dir/$jour

# Duree de conservation des donnees

retention=30

# Dump de la base 

sudo mysqldump -u root grh > $backup_dir/$jour/grh_$jour.sql

# Supression des fichiers

find $backup_dir/* -mtime +$retention -delete
