<?php
require 'base.php';
include 'util.php';
include_once 'langues.php';
session_start();
start_page();
nav_bar();

if (!isset($_SESSION['categorie']) ||  $_SESSION['categorie'] != 'Premium' && $_SESSION['categorie'] != 'Admin' && $_SESSION['categorie'] != 'Trad'){
    header('Location: translation.php');
    exit();
}

?>
    Recherche d'une traduction avec tri par pertinance :
    <form action="ask_translation-processing.php" method="post">
        <select name="from"> <?php set_options($_SESSION['from']); ?> </select>
        <input type="text" name="to_find"/>
        <input type="submit" name="action" value="Rechercher"/>
    </form>
    <p><?php echo 'mot le plux proche : ' . $_SESSION['found']; ?></p>
    <form action="translation-processing.php" method="post">
        <input type="hidden" name="from" value="<?php echo $_SESSION['from']; ?>"/>
        <input type="hidden" name="to_translate" value="<?php echo $_SESSION['found'];?>"/>
        <select name="to"> <?php set_options($_SESSION['to']); ?> </select>
        <input type="submit" name="action" value="translate"/>
    </form>

<? echo $_SESSION['resultat']; $_SESSION['resultat'] = ''; $_SESSION['found'] = '';?>

    Detecter une langue :
    <form action="ask_translation-processing.php" method="post">
        <input type="text" name="to_ask" <?php set_word($_SESSION['to_translate']); ?>/>
        <input type="submit" name="action" value="Détecter langue"/>
        <?php echo $_SESSION['detectlang']; $_SESSION['detectlang'] = '';  ?>
    </form>

    Demander une traduction inexistante :
    <form action="ask_translation-processing.php" method="get">
        <select name="from">
            <?php set_options($_SESSION['from']); ?>
        </select>
        <input type="text" name="to_ask" <?php set_word($_SESSION['to_translate']); ?>/>
        <select name="to">
            <?php set_options($_SESSION['to']); ?>
        </select>
        <input type="submit" name="action" value="ask"/>
    </form>

    Historique de mes demandes : <br>
<?php

$query = 'SELECT *
          FROM translation_request
          WHERE user_id=\''.$_SESSION['id'].'\'';
$dbResult = mysqli_query($dbLink, $query);
while ($dbRow = mysqli_fetch_assoc($dbResult)) {
    echo 'Demande de traduction du mot ' . $dbRow['word'] .
        ' de la langue ' . $dbRow['from_lang'] . ' à la langue ' . $dbRow['to_lang'] .
        ', statut : ' . $dbRow['state'] . '<br>';
}

?>




<?php echo $_SESSION['samelang']; $_SESSION['samelang'] = '' ?>


<?php
footer();
end_page();
?>