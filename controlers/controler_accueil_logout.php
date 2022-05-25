<?php

function accueil()
{
    require('./views/view_accueil.php');
}


function logout()
{
    // require ('./views/view_logout.php');
    $_SESSION = array();
    session_destroy();
    sleep(1);
    header('Location: index.php?action=accueil');
}