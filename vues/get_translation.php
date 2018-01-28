<?php
include ('modeles/langues.php');
session_start();

function export() {?>
<br>Exporter une langue
    <form action="../get_translation-processing.php" method="post">
        <select name="language">
            <?php set_options($_SESSION['exported_lang']); ?>
        </select>
        <input type="hidden" name="action" value="export">
        <input type="submit" value=<?php echo _('Export traduction');?>/>
    </form>
    <a href="<?php echo isset($_SESSION['tradfilename']) ? $_SESSION['tradfilename'] : "#"?>"
       style="display:<?php echo isset($_SESSION['tradfilename']) ? '' : 'none'; unset($_SESSION['tradfilename'])?>;"
       download>
        <?php echo _('Download')?>
    </a><br>
<?php }