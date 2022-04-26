<?php

///////////////////////////////////
/////Constantes horaires
//////////////////////////////////

//Journée maximale de travail effectif 10h
const JOURNEE_MAX = 10 * 3600;

//Plages horaires du matin arrivée entre 7h30 et 9h30
const MATIN_1 = (7 * 3600) + (30 * 60);
const MATIN_2 = (9 * 3600) + (30 * 60);

//Plages horaires pause méridienne
//Premier pointage entre 11h30 et 13h15, retour max 14h
//Pause minimum décomptée 45' même si pause réelle < 45'
//Pause maximale 2h30 de 11h30 à 14h
const PAUSE_1 = (11 * 3600) + (30 * 60);
const PAUSE_2 = (13 * 3600) + (15 * 60);
const PAUSE_RETOUR = 14 * 3600;
const PAUSE_MIN = 45 * 60;
const PAUSE_MAX = (2 * 3600) + (30 * 60);

//Plages horaire après midi départ à partir de 16h jusqu'à 19h
const SOIR_1 = 16 * 3600;
const SOIR_2 = 19 * 3600;

?>