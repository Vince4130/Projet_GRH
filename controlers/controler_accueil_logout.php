<?php

function accueil()
{
    require('./views/view_accueil.php');
}


function logout()
{
    $_SESSION = array();
    session_destroy();
    sleep(1);
    header('Location: index.php?action=accueil');
}