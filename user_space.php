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
                        <div class="form-group">
                            <label><?php echo _('E-mail : ') ?></label>
                            <input class="form-control" type="email" name="id"/>
                            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                        </div>
                        <div class="form-group">
                            <label><?php echo _('Password : ') ?></label>
                            <input class="form-control" type="password" name="mdp"/>
                        </div>
                        <input type="hidden" name="action" value="a_log_in">
                        <input class="btn btn-primary" type="submit" value="<?php echo _('Log in ')?>"/>
                    </form>
                    </p>
                    <div class="alert alert-danger" style="display:<?php echo isset($_SESSION['connexionfailed']) ? '' : 'none';
                    unset($_SESSION['connexionfailed']) ?>;">
                        <?php echo _('Wrong e-mail or password') ?>
                    </div>
                </article>

                <article class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                    <form action="data-processing.php" method="post">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label"><?php echo _('Username')?></label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" name="pseudo"/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label"><?php echo _('E-mail')?></label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" name="mail"/>
                                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label><?php echo _('Password')?></label>
                                <input class="form-control" type="password" name="mdp"/>
                            </div>
                            <div class="form-group col-md-6">
                                <label><?php echo _('Password verification')?></label>
                                <input class="form-control" type="password" name="confirmationmdp"/>
                            </div>
                        </div>
                        <input type="hidden" name="action" value="a_sign_in">
                        <input class="btn btn-primary" type="submit" value="<?php echo _('Sign in ')?>"/>
                    </form>

                    <div class="alert alert-danger" role="alert" style="display:<?php echo isset($_SESSION['mailpris']) ? '' : 'none';
                    unset($_SESSION['mailpris']) ?>;">
                        <?php echo _('Invalid E-mail') ?>
                    </div>

                    <div class="alert alert-danger" role="alert" style="display:<?php echo isset($_SESSION['pseudopris']) ? '' : 'none';
                    unset($_SESSION['pseudopris']) ?>;">
                        <?php echo _('Username already taken') ?>
                    </div>

                    <div class="alert alert-danger" role="alert" style="display:<?php echo isset($_SESSION['mauvaismdp']) ? '' : 'none';
                    unset($_SESSION['mauvaismdp']) ?>;">
                        <?php echo _('Password verification fail') ?>
                    </div>

                </article>
            </section>
        </div>

        <?php
    }
    else
        {
            ?>
            <script type="text/javascript" src="js/functions.js"> </script>

            <div class="container-fluid section">
                <p style="display:<?php echo isset($_SESSION['inscriptionreussie']) ? '' : 'none';
                unset($_SESSION['inscriptionreussie']) ?>;">
                    <?php echo _('Welcome to our Web Site ! ')?> <br>
                </p>

                <h1><?php echo _('Personal space : ') ?></h1>

                <h3><?php echo _('Your E-mail : ')?></h3>
                <div class="alert alert-secondary" role="alert">
                    <?php echo $_SESSION['mail'] ?>
                </div>
                <h3><?php echo _('Your User-name : ') ?></h3>
                <div class="alert alert-secondary" role="alert">
                    <?php echo $_SESSION['pseudo'] ?>
                </div>
                <h3><?php echo _('Your grade : ') ?></h3>
                <div class="alert alert-secondary" role="alert">
                    <?php $_SESSION['categorie'] ?>
                </div>

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
            </div>
        <?php
    }
    end_page();
?>
