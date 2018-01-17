<?php
include 'util.php';
session_start();
start_page();
nav_bar();
?>
        <form action="translation-processing.php" method="get">
            <select name="from">
                <option value="english">Anglais</option>
                <option value="french">Français</option>
            </select>
            <input type="text" name="to_translate"/>
            <select name="to">
                <option value="french">Français</option>
                <option value="english">Anglais</option>
            </select>
            <input type="submit" name="action" value="translate"/>
        </form>

<?php
echo $_SESSION['resultat'];
footer();
end_page();
?>
