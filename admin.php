<?php
session_start();
if(!isset($_SESSION['categorie']) || $_SESSION['categorie'] != 'Admin' )
{
    header('Location: user_space.php');
    exit();
}
include_once('vues/util.php');
include('modeles/base.php');
start_page();
nav_bar();

?>

<form action="admin-processing.php" method="post">
    <?php echo _('Nom de la langue en français : ')?><input type="text" name="fr">
    <?php echo _('Nom de la langue en anglais : ')?><input type="text" name="en">
    <?php echo _('Nom de la langue dans sa propre langue : ')?><input type="text" name="new">
    <input type="hidden" name="action" value="Ajouter une langue">
    <input type="submit" value="<?php echo _('Ajouter une langue')?>" >
</form>

<?php
if(isset($_SESSION['newlangsucces'])){
    echo $_SESSION['newlangsucces'];
    unset($_SESSION['newlangsucces']);
}

echo _('Liste des utilisateurs enregistrés sur le site :') .' <br> <div style="font-family: monospace;"><div style=" white-space: pre;">'

        . str_pad('E-mail', 40, ' ', STR_PAD_BOTH) . '|'
        . str_pad('Pseudo', 30, ' ', STR_PAD_BOTH) . '|'
        . str_pad('Date inscription', 20, ' ', STR_PAD_BOTH) . '|'
        . str_pad('Categorie', 20, ' ', STR_PAD_BOTH) . '|</div><br>';

$query = 'SELECT * FROM user ';

if(!($dbResult = mysqli_query($dbLink, $query)))
{
    echo _('Erreur dans la requete') .'<br />';
    echo '<a href="user_space.php">' ._('Revenir à l\'authetification') .'</a>';
    exit();
}

while($row = mysqli_fetch_assoc($dbResult))
{
    echo '<div style=" white-space: pre; display: inline;">' . str_pad($row['email'], 40, ' ', STR_PAD_BOTH) . '|'
        . str_pad($row['pseudo'], 30, ' ', STR_PAD_BOTH) . '|'
        . str_pad($row['date'], 20, ' ', STR_PAD_BOTH) . '|'
        . str_pad($row['categorie'], 20, ' ', STR_PAD_BOTH)
        . '|</div><form style="display: inline" action="admin-processing.php" method="post">
                    <input type="hidden" name="mail" value="'. $row['email'] . '">
                    <input type="submit" name="standard" value="Standard">
                    <input type="submit" name="premium" value="Premium"> 
                    <input type="submit" name="traducteur" value="Trad"> 
                    <input type="submit" name="administrateur" value="Admin">
                </form><br>';
}
echo '</div>';


?>


