<?php
include 'base.php';
include 'util.php';
include_once 'langues.php';
session_start();

// Sécurité pour savoir si utilisateur admin
if (!isset($_SESSION['categorie']) || $_SESSION['categorie'] != 'Admin' && $_SESSION['categorie'] != 'Trad') {
    header('Location: translation.php');
    exit();
}

start_page();
nav_bar();
?>
        <div class="container">
            <div class="jumbotron">
<?php
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

?>
            </div>
            <div class="page-header"><h2>Toutes les demandes de traductions en cours : </h2></div>

<?php
check_requests();

$query = 'SELECT *
          FROM translation_request
          WHERE state=\'en cours\'';
$dbResult = mysqli_query($dbLink, $query);
?>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Mot</th>
                        <th scope="col">Langue d'origine</th>
                        <th scope="col">Langue demandé</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>

<?php
while ($dbRow = mysqli_fetch_assoc($dbResult)) {
    echo    '<tr>
                <td>' . $dbRow['word'] . '</td><td>'. $dbRow['from_lang'] . '</td><td>' . $dbRow['to_lang'] . '</td><td>' . $dbRow['state'] . '</td>
                <td>
                        <form style="display: inline"  action="get_translation-processing.php" method="post"> 
                                <input type="hidden" name="id" value="' . $dbRow['id'] .'">
                                <input type="hidden" name="word" value="' . $dbRow['word'] .'">
                                <input type="hidden" name="from_lang" value="' . $dbRow['from_lang'] .'">
                                <input type="hidden" name="to_lang" value="' . $dbRow['to_lang'] .'">
                                <input class="btn btn-success" type="submit" name="action" value="Résoudre">
                                <input class="btn btn-danger" type="submit" name="action" value="Refuser">
                        </form>
                </td>
            </tr>';
}
?>
                </tbody>
            </table>
            <div class="jumbotron">
                <h2>Exporter une langue</h2>
                <form class="form-inline" action="get_translation-processing.php" method="post">
                    <select class="form-control" name="language">
                        <?php set_options($_SESSION['exported_lang']); ?>
                    </select>
                    <input type="hidden" name="action" value="export">
                    <input class="btn btn-primary" type="submit" value=<?php echo _('Export traduction');?>/>
                </form>
                <a href="<?php echo isset($_SESSION['tradfilename']) ? $_SESSION['tradfilename'] : "#"?>"
                   style="display:<?php echo isset($_SESSION['tradfilename']) ? '' : 'none'; unset($_SESSION['tradfilename'])?>;"
                   download>
                    <?php echo _('Download')?>
                </a><br>
            </div>

            <div class="page-header"><h2>Traductions présentes en base de donnée</h2> </div>

<?php
$query = 'SELECT * FROM translation ORDER BY lang';
$dbResult = mysqli_query($dbLink, $query);
?>

            <table class="table">
                <thead>
                <tr>
                    <th scope="col">Mot Anglais</th>
                    <th scope="col">Langue</th>
                    <th scope="col">Traduction</th>
                    <th scope="col">Action</th>
                </tr>
                </thead>
                <tbody>

<?php
while ($dbRow = mysqli_fetch_assoc($dbResult)){
    echo    '<tr>
                <td>' . $dbRow['word'] . '</td><td>'. $dbRow['lang'] . '</td><td>' . $dbRow['translation'] . '</td>
                <td>
                        <form style="display: inline"  action="get_translation-processing.php" method="post"> 
                                <input type="hidden" name="id" value="' . $dbRow['trad_id'] .'">
                                <input type="hidden" name="word" value="' . $dbRow['word'] .'">
                                <input type="hidden" name="translation" value="' . $dbRow['translation'] .'">
                                <input type="hidden" name="lang" value="' . $dbRow['lang'] .'">
                                <input class="btn btn-warning" type="submit" name="action" value="Modifier">
                                <input class="btn btn-danger" type="submit" name="action" value="Supprimer">
                        </form>
                </td>
            </tr>';
}
?>
                </tbody>
            </table>
        </div>
<?php
footer();
end_page();
?>