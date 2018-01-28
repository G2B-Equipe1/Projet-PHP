<?php
include 'vues/util.php';
start_page();
nav_bar();
if($_GET['verifPasswrds'] == 'goodPasswrds')
    echo 'Mot de passe changé !';
else if($_GET['verifPasswrds'] == 'badPasswrds')
    echo 'Les deux mots de passes ne sont pas identiques.';
else if($_GET['verifPasswrds'] == 'timeOut')
    echo 'Temps dépassé, veuillez renouveler votre demande de réinitialisation.';
?>

<form method="post" action="password_reinitialisation.php?token=<?php echo $_GET['token'];?>">
    <p><?php echo _('Nouveau mot de passe :')?> <input type="password" name="pass" required></p>
    <p><?php echo _('retapez le nouveau mot de passe :')?> <input type="password" name="pass2" required></p>
    <input type="hidden" name="action" value="modifier"/>
    <input type="submit"  value="<?php echo _('modifier')?>"/>
</form>