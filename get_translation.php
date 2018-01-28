<?php
include_once 'modeles/base.php';
include_once 'vues/util.php';
include_once 'modeles/langues.php';
include_once 'vues/get_translation.php';
session_start();
start_page();
nav_bar();



if (!isset($_SESSION['categorie']) || $_SESSION['categorie'] != 'Admin' && $_SESSION['categorie'] != 'Trad') {
    header('Location: translation.php');
    exit();
}
if(!isset($_SESSION['resolve_trad']) && !isset($_SESSION['resolve_trad2']) && !isset($_SESSION['modiftrad'])){
    $_SESSION['simpletrad'] = true;
    echo 'Entrer une nouvelle traduction dans la base de données : ';
    form_insert_word($_SESSION['to_translate'],'english', 'french');

}
else if(isset($_SESSION['resolve_trad'])){
    $_SESSION['simpletrad'] = true;
    echo $_SESSION['resolve_trad'];
    form_insert_word($_SESSION['to_translate'],$_SESSION['from'], $_SESSION['to']);
    unset($_SESSION['resolve_trad']);
}
else if(isset($_SESSION['resolve_trad2'])){
    $_SESSION['simpletrad'] = false;
    $_SESSION['firsttrad'] = true;
    echo $_SESSION['resolve_trad2'];
    if($_SESSION['tradtemp'] == '')
        form_insert_word($_SESSION['to_translate'],$_SESSION['from'], $_SESSION['to']);
    $_SESSION['firsttrad'] = false;
    form_insert_word($_SESSION['tradtemp'],$_SESSION['from2'], $_SESSION['to2']);
    echo $_SESSION['firstfirst'];
    $_SESSION['firstfirst'] = '';
    $_SESSION['simpletrad'] = true;
}
else if(isset($_SESSION['modiftrad'])){
    echo $_SESSION['modiftrad'];
    form_insert_word($_SESSION['to_translate'],$_SESSION['from'], $_SESSION['to']);
    unset($_SESSION['modiftrad']);
}

echo $_SESSION['samelang'];
$_SESSION['samelang'] = '';
echo $_SESSION['add_success'];
$_SESSION['add_success'] = '';

echo 'Toutes les demandes de traductions en cours : <br>';
check_requests();

$query = 'SELECT *
          FROM translation_request
          WHERE state=\'en cours\'';
$dbResult = mysqli_query($dbLink, $query);
while ($dbRow = mysqli_fetch_assoc($dbResult)) {
    echo 'Demande de traduction du mot <b> ' . $dbRow['word'] .
        '</b> de la langue <b>' . $dbRow['from_lang'] . '</b> à la langue <b>' . $dbRow['to_lang'] .
        '</b>, statut : <b>' . $dbRow['state'] . '</b>
                        <form style="display: inline"  action="get_translation-processing.php" method="post"> 
                                <input type="hidden" name="id" value="' . $dbRow['id'] .'">
                                <input type="hidden" name="word" value="' . $dbRow['word'] .'">
                                <input type="hidden" name="from_lang" value="' . $dbRow['from_lang'] .'">
                                <input type="hidden" name="to_lang" value="' . $dbRow['to_lang'] .'">
                                <input type="submit" name="action" value="Résoudre">
                                <input type="submit" name="action" value="Refuser">
                        </form>' . '<br>';
}
?>

export();

<?php echo '<br>Traductions présentes en base de donnée : <br><br>';

$query = 'SELECT * FROM translation';
$dbResult = mysqli_query($dbLink, $query);
while ($dbRow = mysqli_fetch_assoc($dbResult)){
    echo 'Traduction du mot anglais <b> ' . $dbRow['word'] . '</b> en <b>' . $dbRow['lang'] . '</b> : <b>' .
        $dbRow['translation'] . '</b>
                        <form style="display: inline"  action="get_translation-processing.php" method="post"> 
                                <input type="hidden" name="id" value="' . $dbRow['trad_id'] .'">
                                <input type="hidden" name="word" value="' . $dbRow['word'] .'">
                                <input type="hidden" name="translation" value="' . $dbRow['translation'] .'">
                                <input type="hidden" name="lang" value="' . $dbRow['lang'] .'">
                                <input type="submit" name="action" value="Modifier">
                                <input type="submit" name="action" value="Supprimer">
                        </form>' . '<br>';
}

footer();
end_page();
?>