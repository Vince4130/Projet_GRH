<?php
@session_start();

require ('./models/model_forgot_pwd.php');

function forgotPwd()
{
   
    if (isset($_POST['submit'])) {

        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    
        $req_exist_mail = existMail($email);
    
        $existMail = $req_exist_mail->fetch(PDO::FETCH_ASSOC);

        if ($existMail) {

            $erreur = false;
            $text_erreur = "Email connu, redirection vers saisie nouveau mot de passe";

            //Variables de session pour l'utilisateur reconnu
            $_SESSION['id'] = (int)($existMail['empid']);
            
        } else {
            $erreur      = true;
            $text_erreur = "Email inconnu";
        }
        
    }

    require ('./views/view_forgot_pwd.php');

}
