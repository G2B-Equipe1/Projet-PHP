<?php
session_start();

function connexion () {?>
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
                    <div class="form-group">
                        <label><?php echo _('Username')?></label>
                        <input class="form-control" type="text" name="pseudo"/>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 col-form-label"><?php echo _('E-mail')?></label>
                        <input class="form-control" type="text" name="mail"/>
                        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                    </div>
                    <div class="form-group">
                        <label><?php echo _('Password')?></label>
                        <input class="form-control" type="password" name="mdp"/>
                    </div>
                    <div class="from-group">
                        <label><?php echo _('Password verification')?></label>
                        <input class="form-control" type="password" name="confirmationmdp"/>
                    </div>
                    <input type="hidden" name="action" value="a_sign_in">
                    <input class="btn btn-primary" type="submit" value="<?php echo _('Sign in ')?>" style="margin-top: 1em"/>
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
    <?php }

function  user_information_and_actions() {?>
    <script type="text/javascript" src="../js/functions.js"> </script>

    <p style="display:<?php echo isset($_SESSION['inscriptionreussie']) ? '' : 'none';
    unset($_SESSION['inscriptionreussie']) ?>;">
        <?php echo _('Welcome to our Web Site ! ')?> <br>
    </p>

    <div class="container">
        <div class="page-header">
            <h1><?php echo _('Personal space : ') ?></h1>
        </div>
        <p>
            <?php echo _('Your E-mail : ') . $_SESSION['mail'] ?><br>
            <?php echo _('Your User-name : ') . $_SESSION['pseudo'] ?><br>
            <?php echo _('Your grade : ') . $_SESSION['categorie'] ?><br>
        </p>

        <div class="jumbotron">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                        <a class="btn btn-primary btn-lg" href="#" data-toggle="collapse" data-target="#change_pwd"><?php echo _('Change password')?></a>
                        <div id="change_pwd" class="collapse <?php if (isset($_SESSION['checker'])) { if ($_SESSION['checker'] == true) { unset($_SESSION['checker']); echo 'in';}}?>">
                            <form action="../data-processing.php" method="post">
                                <div class="form-group">
                                    </br>
                                    <label><?php echo _('Actual password : ') ?></label>
                                    <input class="form-control" type="password" name="ancienmdp"/>
                                    <label><?php echo _('New password : ') ?></label>
                                    <input class="form-control" type="password" name="nouveaumdp"/>
                                    <label><?php echo _('New password verification') ?></label>
                                    <input class="form-control" type="password" name="confirmationmdp"/>
                                </div>
                                <input type="hidden" name="action" value="a_change_password">
                                <input class="btn btn-warning" type="submit" value="<?php echo _('Change password') ?>">
                            </form>
                        </div>
                        <div style="display:<?php echo isset($_SESSION['changesuccess']) ? '' : 'none';
                        unset($_SESSION['changesuccess']) ?>;">
                            <?php echo _('Password change sucess') ?>
                        </div>
                        <div class="alert alert-danger" role="alert" style="display:<?php echo isset($_SESSION['changefail1']) ? '' : 'none';
                        unset($_SESSION['changefail1']) ?>;">
                            <?php echo _('Wrong old password') ?>
                        </div>
                        <div class="alert alert-danger" role="alert" style="display:<?php echo isset($_SESSION['changefail2']) ? '' : 'none';
                        unset($_SESSION['changefail2']) ?>;">
                            <?php echo _('New password confirmation fail') ?>
                        </div>
                    </div>

                    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                        <a class="btn btn-warning btn-lg" data-toggle="collapse" data-target="#delete" href="#"><?php echo _('Delete my account')?></a>
                        <div id="delete" class="collapse <?php if (isset($_SESSION['checker2'])) { if ($_SESSION['checker2'] == true) { unset($_SESSION['checker2']); echo 'in';}}?>">
                            <form action="data-processing.php" method="post">
                                <div class="form-group">
                                    </br>
                                    <label><?php echo _('Password : ') ?></label>
                                    <input class="form-control" type="password" name="mdp"/>
                                </div>

                                <div class="alert alert-danger" style="display:<?php echo isset($_SESSION['wrongmdp']) ? '' : 'none';
                                unset($_SESSION['wrongmdp']) ?>;">
                                    <?php echo _('Wrong password') ?>
                                </div>
                                <input type="hidden" name="action" value="a_delete_account">
                                <input class="btn btn-danger" type="submit" value="<?php echo _('Delete') ?>"/></br>
                                <small class="text-danger"><?php echo _('Your account will be deleted forever') ?></small>
                            </form>
                        </div>
                    </div>

                    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                        <form action="data-processing.php" method="post" >
                            <input type="hidden" name="action" value="a_log_out">
                            <input class="btn btn-primary btn-lg" type="submit" value="<?php echo _('Log out')?>">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php }


?>