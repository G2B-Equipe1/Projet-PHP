<?php
include 'util.php';
session_start();
if($_SESSION['categorie'] != 'translator' && $_SESSION['categorie'] != 'admin') {
    header('Location: user_space.php');
    exit();
}
start_page();
nav_bar();
?>

<div class="container text-center">
    <div class="row">
        <div class="col-sm-4">
            <form action="translator-processing.php" method="post">
                <select name="language">
                    <option value="english"><?php echo _('English');?></option>
                    <option value="french"><?php echo _('French');?></option>
                </select>
                <input type="hidden" name="action" value="export">
                <input type="submit" value=<?php echo _('Export traduction');?>/>
            </form>
        </div>
        <div class="col-sm-4">
            <a href="<?php echo isset($_SESSION['tradfilename']) ? $_SESSION['tradfilename'] : "#"?>"
               style="display:<?php echo isset($_SESSION['tradfilename']) ? '' : 'none'; unset($_SESSION['tradfilename'])?>;"
               download>
                <?php echo _('Download')?>
            </a>
        </div>
    </div>
</div>

<?php
footer();
end_page();
?>

