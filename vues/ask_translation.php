<?php
session_start();

function pertinance () {?>
    <div class="container">
        <div class="jumbotron row">
            <div class="col-sm-6">
                Recherche d'une traduction avec tri par pertinance :
                <form class="form-inline" action="ask_translation-processing.php" method="post">
                    <div class="form-group">
                        <select class="form-control" name="from"> <?php if (isset($_SESSION['from'])) {set_options($_SESSION['from']);} else {set_options('english');} ?> </select>
                        <input class="form-control" type="text" name="to_find" <?php if (isset($_SESSION['found'])) {echo 'value="'.$_SESSION['found'].'"';}?>/>
                    </div>
                    <input class="btn btn-default" type="submit" name="action" value="Rechercher"/>
                </form>
                <?php if (isset($_SESSION['found'])) {echo '<div class="alert alert-info"> Mot le plux proche : ' . $_SESSION['found'].'</div>'; ?>
                <form class="form-inline" action="ask_translation-processing.php" method="post">
                    <input type="hidden" name="from" value="<?php if (isset($_SESSION['from'])) {echo $_SESSION['from'];} ?>"/>
                    <input type="hidden" name="to_translate" value="<?php if (isset($_SESSION['found'])) {echo $_SESSION['found'];} ?>"/>
                    <input type="hidden" name="prenium-request" value="true"/>

                    <select class="form-control" name="to"> <?php if (isset($_SESSION['to'])) {set_options($_SESSION['to']);} else {set_options('french');} ?> </select>

                    <input class="btn btn-primary" type="submit" name="action" value="Traduire"/>
                    <?php if(isset($_SESSION['resultat'])) echo $_SESSION['resultat'];} ?>
                </form>

            </div>
<?php }

function ask_translation() {?>
    <div class="col-sm-6">
        Demander une traduction inexistante :
        <form class="form-inline" action="ask_translation-processing.php" method="get">
            <select class="form-control" name="from">
                <?php set_options($_SESSION['from']); ?>
            </select>
            <input class="form-control" type="text" name="to_ask" <?php if (isset($_SESSION['to_translate'])) { set_word($_SESSION['to_translate']);} ?>/>
            <select class="form-control" name="to">
                <?php set_options($_SESSION['to']); ?>
            </select>
            </br>
            <input class="btn btn-primary btn-block" style="margin-top: 1em" type="submit" name="action" value="Envoyer"/>
        </form>
    </div>
    </div>
    </div>
    <div class="container">
        <?php if (isset($_SESSION['resultat'])) {echo $_SESSION['resultat'];} unset($_SESSION['resultat']);?>
    </div>
<?php }

function detect_lang() {?>
    <div class="container">
        <div class="jumbotron row">
            Detecter une langue :
            <form class="form-inline" action="ask_translation-processing.php" method="post">
                <input class="form-control" type="text" name="to_ask" <?php if (isset($_SESSION['to_translate'])) { set_word($_SESSION['to_translate']);} ?>/>
                <input class="btn btn-primary" type="submit" name="action" value="Détecter langue"/>
            </form>
            <?php if (isset($_SESSION['detectlang'])) {echo '<div class="alert alert-info">'.$_SESSION['detectlang'].'</div>'; unset($_SESSION['detectlang']);}  ?>
        </div>
    </div>
<?php }