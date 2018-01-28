<?php
require_once 'modeles/base.php';
require_once 'mail.php';
if($_POST['mail'] == null || !preg_match('/^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$/', $_POST['mail']))
    $verifMail = 'badMail';
else {
    $mail = $_POST['mail'];
    $queryVerif = 'SELECT * FROM user WHERE email = \'' . $mail . '\'';
    $result = mysqli_query($dbLink, $queryVerif);
    $nbResult = mysqli_num_rows($result);
    if($nbResult != 1) {
        $verifMail = 'unknownMail';
    }
    else {
        $verifMail = 'goodMail';
        $result = mysqli_fetch_assoc($result);
        $idUser = $result['id'];
        $token = md5(uniqid(mt_rand()));
        $expire = time() + 1800;
        $queryAddToken = 'INSERT INTO tokens (idUser, token, expire) VALUES (\'' . $idUser . '\', \'' . $token . '\', \'' . $expire . '\')';
        if((!$result = mysqli_query($dbLink, $queryAddToken))) {
            echo _('La requete ajout token a foiré');
        }
        $to = $mail;
        $from = 'no-reply@truc.com';
        $subject = 'Mot de passe oublié';
        $text_message = 'Cliquez sur le lien suivant pour accéder a la page de réinitailisation de mot de passe:' . "\n";
        $text_message .= 'http://http://projet-php-g2b-vituo-linguo.alwaysdata.net/edit_password.php?token=' . $token;
        if (!send_mail($to, $from, $subject, $text_message))
            echo _('message pas envoyé');
    }
}
header('location: forgot_password.php?verifMail=' . $verifMail);