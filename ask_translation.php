<?php
require 'base.php';
include 'util.php';
include_once 'langues.php';
session_start();
start_page();
nav_bar();

if (!isset($_SESSION['categorie']) ||  $_SESSION['categorie'] != 'Premium' && $_SESSION['categorie'] != 'Admin' && $_SESSION['categorie'] != 'Trad'){
    header('Location: translation.php');
    exit();
}

?>
    <div class="container">
        <div class="jumbotron row">
            <div class="col-sm-6">
                Recherche d'une traduction avec tri par pertinance :
                <form class="form-inline" action="ask_translation-processing.php" method="post">
                    <div class="form-group">
                        <select class="form-control" name="from"> <?php set_options($_SESSION['from']); ?> </select>
                        <input class="form-control" type="text" name="to_find"/>
                    </div>
                    <input class="btn btn-default" type="submit" name="action" value="Rechercher"/>
                </form>
                <?php if (isset($_SESSION['found'])) {echo '<div class="alert alert-info"> Mot le plux proche : ' . $_SESSION['found'].'</div>';} ?>
                <form class="form-inline" action="translation-processing.php" method="post">
                    <input type="hidden" name="from" value="<?php if (isset($_SESSION['from'])) {echo $_SESSION['from'];} ?>"/>
                    <input type="hidden" name="to_translate" value="<?php if (isset($_SESSION['found'])) {echo $_SESSION['found'];} ?>"/>

                    <select class="form-control" name="to"> <?php set_options($_SESSION['to']); ?> </select>

                    <input class="btn btn-primary" type="submit" name="action" value="Traduire"/>

                </form>
                <? echo $_SESSION['resultat']; unset($_SESSION['resultat']); unset($_SESSION['found']);?>
            </div>

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
        <div class="jumbotron row">
            Detecter une langue :
            <form class="form-inline" action="ask_translation-processing.php" method="post">
                <input class="form-control" type="text" name="to_ask" <?php if (isset($_SESSION['to_translate'])) { set_word($_SESSION['to_translate']);} ?>/>
                <input class="btn btn-primary" type="submit" name="action" value="Détecter langue"/>
            </form>
            <?php if (isset($_SESSION['detectlang'])) {echo '<div class="alert alert-info">'.$_SESSION['detectlang'].'</div>'; unset($_SESSION['detectlang']);}  ?>
        </div>
    </div>

    <div class="container">
        <div class="page-header" style="margin-top: 0">
            <h1 style="margin-top: 0"><span class="glyphicon glyphicon-list-alt"></span>  Historique de mes demandes</h1>
        </div>
        <?php

        $query = 'SELECT *
          FROM translation_request
          WHERE user_id=\''.$_SESSION['id'].'\'';
        $dbResult = mysqli_query($dbLink, $query);
        if (mysqli_num_rows($dbResult) == 0) {
            echo $query_result = '<div class="alert alert-info"><p> Vous n\'avez encore fais aucune demande </p></div>';
        } else {
            while ($dbRow = mysqli_fetch_assoc($dbResult)) {
                echo 'Demande de traduction du mot ' . $dbRow['word'] .
                    ' de la langue ' . $dbRow['from_lang'] . ' à la langue ' . $dbRow['to_lang'] .
                    ', statut : ' . $dbRow['state'] . '<br>';
            }
        }


        ?>
    </div>





<?php if (isset($_SESSION['samelang'])) {echo $_SESSION['samelang']; unset($_SESSION['samelang']); } ?>


<?php
footer();
end_page();
?>