<?php
include 'util.php';
session_start();

function set_from () {
    if ($_SESSION['from'] == 'english') {
        ?>
        <option value="english" selected>Anglais</option>
        <option value="french">Français</option>
        <option value="spanish">Espagnol</option>
        <?php
    } else if ($_SESSION['from'] == 'french') {
        ?>
        <option value="english">Anglais</option>
        <option value="french"  selected>Français</option>
        <option value="spanish">Espagnol</option>
        <?php
    } else if ($_SESSION['from'] == 'spanish') {
        ?>
        <option value="english">Anglais</option>
        <option value="french">Français</option>
        <option value="spanish" selected>Espagnol</option>
        <?php
    } else {
        ?>
        <option value="english" selected>Anglais</option>
        <option value="french">Français</option>
        <option value="spanish">Espagnol</option>
        <?php
    }
}

function set_to () {
    if ($_SESSION['to'] == 'english') {
        ?>
        <option value="english" selected>Anglais</option>
        <option value="french">Français</option>
        <option value="spanish">Espagnol</option>
        <?php
    } else if ($_SESSION['to'] == 'french') {
        ?>
        <option value="english">Anglais</option>
        <option value="french"  selected>Français</option>
        <option value="spanish">Espagnol</option>
        <?php
    } else if ($_SESSION['to'] == 'spanish') {
        ?>
        <option value="english">Anglais</option>
        <option value="french">Français</option>
        <option value="spanish" selected>Espagnol</option>
        <?php
    } else {
        ?>
        <option value="english">Anglais</option>
        <option value="french" selected>Français</option>
        <option value="spanish">Espagnol</option>
        <?php
    }
}

function set_word () {
    if (isset($_SESSION['to_translate'])) {
        echo 'value="'.$_SESSION['to_translate'].'"';
    } else {
        return;
    }
}

start_page();
nav_bar();
?>
        <form action="translation-processing.php" method="get">
            <select name="from">
                <?php set_from(); ?>
            </select>
            <input type="text" name="to_translate" <?php set_word(); ?>/>
            <select name="to">
                <?php set_to(); ?>
            </select>
            <input type="submit" name="action" value="translate"/>
        </form>

<?php
if (isset($_SESSION['resultat'])) {
    echo $_SESSION['resultat'];
    $_SESSION['resultat'] = null;
}
if (isset($_SESSION['get_trad'])) {
    echo $_SESSION['get_trad'];
    $_SESSION['get_trad'] = null;
}
if (isset($_SESSION['ask_trad'])) {
        echo $_SESSION['ask_trad'];
        $_SESSION['ask_trad'] = null;
}
footer();
end_page();
?>
