<?php

function connexion () {?>
    <div class="container-fluid section">
        <section class="row">
            <article class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                <form action="data-processing.php" method="post">
                    <div class="form-group">
                        <label><?php echo _('E-mail : ') ?></label>
                        <input class="form-control" type="email" name="id"/>
                        <small id="emailHelp" class="form-text text-muted"><?php echo _('We\'ll never share your email with anyone else.')?></small>
                    </div>
                    <div class="form-group">
                        <label><?php echo _('Mot de passe : ') ?></label>
                        <input class="form-control" type="password" name="mdp"/>
                    </div>
                    <input type="hidden" name="action" value="a_log_in">
                    <input class="btn btn-primary" type="submit" value="<?php echo _('Connection ')?>"/>
                </form>
                <a href="forgot_password.php"><?php echo _('Mot de passe oublié ?')?></a>
                </p>
                <div class="alert alert-danger" style="display:<?php echo isset($_SESSION['connexionfailed']) ? '' : 'none';
                unset($_SESSION['connexionfailed']) ?>;">
                    <?php echo _('Wrong e-mail or password') ?>
                </div>
            </article>

            <article class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                <form action="data-processing.php" method="post">
                    <div class="form-group">
                        <label><?php echo _('Pseudo')?></label>
                        <input class="form-control" type="text" name="pseudo"/>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 col-form-label"><?php echo _('E-mail')?></label>
                        <input class="form-control" type="text" name="mail"/>
                        <small id="emailHelp" class="form-text text-muted"><?php echo _('Nous ne partagerons pas votre e-mail à qui que soit')?></small>
                    </div>
                    <div class="form-group">
                        <label><?php echo _('Mot de passe')?></label>
                        <input class="form-control" type="password" name="mdp"/>
                    </div>
                    <div class="from-group">
                        <label><?php echo _('Repeter le mot de passe')?></label>
                        <input class="form-control" type="password" name="confirmationmdp"/>
                    </div>
                    <input type="hidden" name="action" value="a_sign_in">
                    <input class="btn btn-primary" type="submit" value="<?php echo _('Connection')?>" style="margin-top: 1em"/>
                </form>

                <div class="alert alert-danger" role="alert" style="display:<?php echo isset($_SESSION['mailpris']) ? '' : 'none';
                unset($_SESSION['mailpris']) ?>;">
                    <?php echo _('E-mail invalide') ?>
                </div>

                <div class="alert alert-danger" role="alert" style="display:<?php echo isset($_SESSION['pseudopris']) ? '' : 'none';
                unset($_SESSION['pseudopris']) ?>;">
                    <?php echo _('Pseudo déjà pris') ?>
                </div>

                <div class="alert alert-danger" role="alert" style="display:<?php echo isset($_SESSION['mdpempty']) ? '' : 'none';
                unset($_SESSION['mdpempty']) ?>;">
                    <?php echo _('Le mot de passe ne doit pas être vide') ?>
                </div>

                <div class="alert alert-danger" role="alert" style="display:<?php echo isset($_SESSION['mauvaismdp']) ? '' : 'none';
                unset($_SESSION['mauvaismdp']) ?>;">
                    <?php echo _('La verification du mot de passe a échoué') ?>
                </div>

            </article>
        </section>
    </div>
    <?php }

function  user_information_and_actions() {?>
    <script type="text/javascript" src="../js/functions.js"> </script>

    <p style="display:<?php echo isset($_SESSION['inscriptionreussie']) ? '' : 'none';
    unset($_SESSION['inscriptionreussie']) ?>;">
        <?php echo _('Bienvenue sur notre site Web ! ')?> <br>
    </p>

    <div class="container">
        <div class="page-header">
            <h1><?php echo _('Espace personnel : ') ?></h1>
        </div>
        <p>
            <?php echo _('Votre E-mail : ') . $_SESSION['mail'] ?><br>
            <?php echo _('Votre pseudo : ') . $_SESSION['pseudo'] ?><br>
            <?php echo _('Votre categorie : ') . $_SESSION['categorie'] ?><br>
        </p>

        <div class="jumbotron">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                        <a class="btn btn-primary btn-lg" href="#" data-toggle="collapse" data-target="#change_pwd"><?php echo _('Change password')?></a>
                        <div id="change_pwd" class="collapse <?php if (isset($_SESSION['checker'])) { if ($_SESSION['checker'] == true) { unset($_SESSION['checker']); echo 'in';}}?>">
                            <form action="data-processing.php" method="post">
                                <div class="form-group">
                                    </br>
                                    <label><?php echo _('Mot de passe actuel : ') ?></label>
                                    <input class="form-control" type="password" name="ancienmdp"/>
                                    <label><?php echo _('Nouveau mot de passe : ') ?></label>
                                    <input class="form-control" type="password" name="nouveaumdp"/>
                                    <label><?php echo _('Repeter le nouveau mot de passe') ?></label>
                                    <input class="form-control" type="password" name="confirmationmdp"/>
                                </div>
                                <input type="hidden" name="action" value="a_change_password">
                                <input class="btn btn-warning" type="submit" value="<?php echo _('Changer le mot de passe') ?>">
                            </form>
                        </div>
                        <div style="display:<?php echo isset($_SESSION['changesuccess']) ? '' : 'none';
                        unset($_SESSION['changesuccess']) ?>;">
                            <?php echo _('Mot de passe changé avec succès') ?>
                        </div>
                        <div class="alert alert-danger" role="alert" style="display:<?php echo isset($_SESSION['changefail1']) ? '' : 'none';
                        unset($_SESSION['changefail1']) ?>;">
                            <?php echo _('Mauvais mot de passe actuel') ?>
                        </div>
                        <div class="alert alert-danger" role="alert" style="display:<?php echo isset($_SESSION['changefail2']) ? '' : 'none';
                        unset($_SESSION['changefail2']) ?>;">
                            <?php echo _('La verification du nouveau mot de passe a échoué') ?>
                        </div>
                    </div>

                    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                        <a class="btn btn-warning btn-lg" data-toggle="collapse" data-target="#delete" href="#"><?php echo _('Delete my account')?></a>
                        <div id="delete" class="collapse <?php if (isset($_SESSION['checker2'])) { if ($_SESSION['checker2'] == true) { unset($_SESSION['checker2']); echo 'in';}}?>">
                            <form action="data-processing.php" method="post">
                                <div class="form-group">
                                    </br>
                                    <label><?php echo _('Mot de passe : ') ?></label>
                                    <input class="form-control" type="password" name="mdp"/>
                                </div>

                                <div class="alert alert-danger" style="display:<?php echo isset($_SESSION['wrongmdp']) ? '' : 'none';
                                unset($_SESSION['wrongmdp']) ?>;">
                                    <?php echo _('Mauvais mot de passe') ?>
                                </div>
                                <input type="hidden" name="action" value="a_delete_account">
                                <input class="btn btn-danger" type="submit" value="<?php echo _('Supprimer') ?>"/></br>
                                <small class="text-danger"><?php echo _('Votre compte va être detruit pour toujours ! ') ?></small>
                            </form>
                        </div>
                    </div>

                    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                        <form action="data-processing.php" method="post" >
                            <input type="hidden" name="action" value="a_log_out">
                            <input class="btn btn-primary btn-lg" type="submit" value="<?php echo _('Deconnection')?>">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php }


?>