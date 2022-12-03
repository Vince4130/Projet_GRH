<?php

/**
 * Vérification de l'existence
 * d'un email en base
 *
 * @param  mixed $email
 * @return object
 */
function existMail($email) 
{
    $bdd = $GLOBALS['bdd'];

    $req_exist_mail = $bdd->prepare("SELECT email, empid FROM employe WHERE email =:email");

    $req_exist_mail->execute(['email' => "$email"]);
    
    return $req_exist_mail;
}