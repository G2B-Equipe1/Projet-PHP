<?php
include 'util.php';
session_start();

start_page();
nav_bar();
?>

        <form action="ask_translation-processing.php" method="post">
            <label>Voulez vous demander la traduction du mot "<?php echo $_SESSION['to_translate']; ?>" en <?php echo $_SESSION['to']; ?> ?</label></br>
            <input type="submit" name="action" value="demander"/>
        </form>

<?php
footer();
end_page();
?>