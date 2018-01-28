<?php

function activation($code, $mail, $pseudo, $mdp) {?>
<form action="data-processing.php" method="post">
    <label> <?php echo _('Entrez le code ici :')?> <input type="text" name="code"></label>
    <input type="hidden" name="realcode" value="<?php echo $code; ?>">
    <input type="hidden" name="mail" value="<?php echo $mail; ?>">
    <input type="hidden" name="pseudo" value="<?php echo $pseudo; ?>">
    <input type="hidden" name="mdp" value="<?php echo $mdp; ?>">
    <input type="hidden" name="action" value="a_activate_account">
    <input type="submit" value="<?php echo _('Activate account') ?>">
</form>
<?php }

function annuler () { ?>
<form action="data-processing.php" method="post">
    <input type="hidden" name="action" value="a_cancel_activation">
    <input type="submit" value="<?php echo _('Annuler l\'activation')?>">
</form>
<?php }


