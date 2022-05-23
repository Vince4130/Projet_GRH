<?php

function existMail($email) 
{
    $bdd = $GLOBALS['bdd'];

    $req_exist_mail = $bdd->prepare("SELECT * FROM employe WHERE email =:email");

    $req_exist_mail->execute(['email' => "$email"]);

    return $req_exist_mail;
}