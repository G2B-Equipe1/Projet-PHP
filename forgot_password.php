<?php
include 'util.php';
start_page();
nav_bar();

if($_GET['verifMail'] == 'goodMail')
    echo 'Mail de réinitialisation envoyé.';
else if($_GET['verifMail'] == 'badMail')
    echo 'Veuillez entrer une adresse mail valide.';
else if($_GET['verifMail'] == 'unknownMail')
    echo 'Mail associé a aucun compte.';
?>

<form method="post" action="processing_password.php">
    <p>Veuillez renseigner votre adresse mail pour l'envoi d'un lien de réinitialisation.</p>
    <input type="text" name="mail" placeholder="xxxxxxx@exemple.com" required>
    <input type="submit" name="action" value="envoyer"/>
</form>