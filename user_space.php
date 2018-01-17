<?php
    if(isset($_COOKIE['confirmail']))
    {
        header('Location : activate.php');
    }
    include_once 'util.php';
    require 'base.php';
    session_start();
    start_page();
    nav_bar();
    if(!isset($_SESSION['mail']))
    {
        ?>


        <div class="container-fluid section">
            <section class="row">
                <article class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                    <form action="data-processing.php" method="post">
                        <label><?php echo _('E-mail : ') ?><input type="text" name="id"/></label>
                        <label><?php echo _('Password : ') ?><input type="password" name="mdp"/></label>
                        <input type="hidden" name="action" value="a_log_in">
                        <input type="submit" value="<?php echo _('Log in ')?>"/>
                    </form>
                    </p>
                    <p style="display:<?php echo isset($_SESSION['connexionfailed']) ? '' : 'none';
                    unset($_SESSION['connexionfailed']) ?>;">
                        <?php echo _('Wrong e-mail or password') ?>
                    </p>
                </article>

                <article class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                    <form action="data-processing.php" method="post">
                        <label><?php echo _('Username : ')?><input type="text" name="pseudo"/></label>
                        <label><?php echo _('E-mail : ')?><input type="text" name="mail"/></label>
                        <label><?php echo _('Password : ')?><input type="password" name="mdp"/></label>
                        <label><?php echo _('Password verification')?><input type="password" name="confirmationmdp"/></label>
                        <input type="hidden" name="action" value="a_sign_in">
                        <input type="submit" value="<?php echo _('Sign in ')?>"/>
                    </form>

                    <p style="display:<?php echo isset($_SESSION['mailpris']) ? '' : 'none';
                    unset($_SESSION['mailpris']) ?>;">
                        <?php echo _('Invalid E-mail') ?>
                    </p>

                    <p style="display:<?php echo isset($_SESSION['pseudopris']) ? '' : 'none';
                    unset($_SESSION['pseudopris']) ?>;">
                        <?php echo _('Username already taken') ?>
                    </p>

                    <p style="display:<?php echo isset($_SESSION['mauvaismdp']) ? '' : 'none';
                    unset($_SESSION['mauvaismdp']) ?>;">
                        <?php echo _('Password verification fail') ?>
                    </p>

                </article>
            </section>
        </div>

        <?php
    }
    else
        {
            ?>
            <script type="text/javascript" src="js/functions.js"> </script>

            <p style="display:<?php echo isset($_SESSION['inscriptionreussie']) ? '' : 'none';
            unset($_SESSION['inscriptionreussie']) ?>;">
                <?php echo _('Welcome to our Web Site ! ')?> <br>
            </p>

            <h1><?php echo _('Personal space : ') ?></h1><br>
            <?php echo _('Your E-mail : ') . $_SESSION['mail'] ?><br>
            <?php echo _('Your User-name : ') . $_SESSION['pseudo'] ?><br>
            <?php echo _('Your grade : ') . $_SESSION['categorie'] ?><br>
            <?php echo _('Change grade : ') ?><br>
            <form action="data-processing.php" method="post">
                <input type="submit" name="action" value="<?php echo _('Change to standard') ?>">
                <input type="submit" name="action" value="<?php echo _('Change to premium') ?>">
                <input type="submit" name="action" value="<?php echo _('Change to traductor') ?>">
                <input type="submit" name="action" value="<?php echo _('Change to administrator') ?>">
            </form>

            <button href="#" onclick="toggleDisplay(changemdp);return false;" ><?php echo _('Change password')?></button>
            <div id="changemdp" style="display:none;">
                <form action="data-processing.php" method="post">
                    <label><?php echo _('Actual password : ') ?><input type="password" name="ancienmdp"/></label>
                    <label><?php echo _('New password : ') ?><input type="password" name="nouveaumdp"/></label>
                    <label><?php echo _('New password verifiaction') ?><input type="password" name="confirmationmdp"/></label>
                    <input type="hidden" name="action" value="a_change_password">
                    <input type="submit" value="<?php echo _('Change password') ?>">
                </form>
            </div>

            <p style="display:<?php echo isset($_SESSION['changesuccess']) ? '' : 'none';
                                unset($_SESSION['changesuccess']) ?>;">
                <?php echo _('Password change sucess') ?>
            </p>
            <p style="display:<?php echo isset($_SESSION['changefail1']) ? '' : 'none';
            unset($_SESSION['changefail1']) ?>;">
                <?php echo _('Wrong old password') ?>
            </p>
            <p style="display:<?php echo isset($_SESSION['changefail2']) ? '' : 'none';
            unset($_SESSION['changefail2']) ?>;">
                <?php echo _('New password confirmation fail') ?>
            </p>

            <form action="data-processing.php" method="post" >
                <input type="hidden" name="action" value="a_log_out">
                <input type="submit" value="<?php echo _('Log out')?>">
            </form>

            <button href="#" onclick="toggleDisplay(supprcompte);return false;" ><?php echo _('Delete my account')?></button>
            <div id="supprcompte" style="display:<?php echo isset($_SESSION['wrongmdp']) ? '' : 'none'; ?>;">
                <form action="data-processing.php" method="post">
                    <label><?php echo _('New password input : ') ?><input type="password" name="mdp"/></label>

                    <p style="display:<?php echo isset($_SESSION['wrongmdp']) ? '' : 'none';
                    unset($_SESSION['wrongmdp']) ?>;">
                        <?php echo _('Wrong password') ?>
                    </p>

                    <br><?php echo _('Account deletion warning') ?>
                    <input type="hidden" name="action" value="a_delete_account">
                    <input type="submit" value="<?php echo _('Delete my account') ?>">
                </form>
            </div>
        <?php
    }
    end_page();
?>
