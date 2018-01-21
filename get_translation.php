<?php
include 'util.php';
session_start();
start_page();
nav_bar();

$from = $_SESSION['from'] ;
$to = $_SESSION['to'];
$to_translate = $_SESSION['to_translate'];

if (!(isset($_SESSION['categorie']))) {
?>

    <p> Pour proposer une définition, inscrivez-vous ou connectez-vous <a class="btn btn-default" href="user_space.php"><span class="glyphicon glyphicon-arrow-right"></span> Espace utilisateur</a> </p>

<?php }
else if ($_SESSION['categorie'] == 'Standard') {
?>
    <p>Donnez une traduction du mot "<?=$to_translate?>" en <?=$to?></p>
    <form action="get_translation-processing.php" method="post">
        <input type="text" name="traduction"/>
        <input type="submit" value="Envoyer"/>
    </form>

<?php }

else if ($_SESSION['categorie'] == 'Premium') {
?>
    <p>Donnez une traduction du mot <?=$to_translate?> en <?=$to?></p>
    <form action="get_translation-processing.php" method="post">
        <input type="text" name="traduction"/>
        <input type="submit" value="Envoyer"/>
    </form>

<?php }

footer();
end_page();
?>