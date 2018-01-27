<?php
require 'base.php';
include_once 'langues.php';
include 'util.php';
session_start();

start_page();
nav_bar();
?>
        <div class="container">
            <div class="page-header">
                <form class="form-inline" action="translation-processing.php" method="get">
                    <select class="form-control" name="from">
                        <?php set_options($_SESSION['from']); ?>
                    </select>
                    <input class="form-control" type="text" name="to_translate" <?php if (isset($_SESSION['to_translate'])) { set_word($_SESSION['to_translate']);} ?>/>
                        <select class="form-control" name="to">
                        <?php set_options($_SESSION['to']); ?>
                    </select>
                    <input class="btn btn-primary" type="submit" name="action" value="translate"/>
                </form>
            </div>
            <div class="page-header">

<?php
if (isset($_SESSION['samelang'])) {
    echo '<div class="alert alert-danger" role="alert">'.$_SESSION['samelang'].'</div>';
    unset($_SESSION['samelang']);
}
if (isset($_SESSION['resultat'])) {
    echo $_SESSION['resultat'];
    $_SESSION['resultat'] = null;
}
?>

                </br>
            </div>

<?php
if (isset($_SESSION['get_trad'])) {
    echo $_SESSION['get_trad'];
    $_SESSION['get_trad'] = null;
}
if (isset($_SESSION['ask_trad'])) {
        echo $_SESSION['ask_trad'];
        $_SESSION['ask_trad'] = null;
}
if (isset($_SESSION['categorie']) && ($_SESSION['categorie'] == 'Admin' || $_SESSION['categorie'] == 'Trad' || $_SESSION['categorie'] == 'Premium')){
    echo '</br><h3><a href="ask_translation.php" class="label label-success">Vos avantages</a><small> Détecter la langue d\'un mot / Demander une traduction /  Voir mon historique de demandes de traductions</small></h3>';
} else if (isset($_SESSION['categorie']) && ($_SESSION['categorie'] == 'Admin' || $_SESSION['categorie'] == 'Trad')){
    echo '</br><h3><a href="ask_translation.php" class="label label-success">Vos avantages</a><small> Détecter la langue d\'un mot / Demander une traduction /  Voir mon historique de demandes de traductions</small></h3>';
    echo '</br><h3><a href="get_translation.php" class="label label-success">Vos outils</a><small> Ajouter une nouvelle traduction / Gérer les demandes de traduction / Modifier une traduction existante </small></h3>';
} else if (isset($_SESSION['categorie']) && $_SESSION['categorie'] == 'Standard') {
    echo '<p>Vous voulez détecter la langue d\'un mot ou encore demander une traduction ?</p>';
    echo '</br><p> Demandez à devenir un de nos membres Prenium a nos admins </p>';
    echo '<h3><a href="about.php" class="label label-warning"> It\'s free! </a></h3>';
} else {
    echo '<p>Vous voulez détecter la langue d\'un mot ou encore demander une traduction ?</p>';
    echo '<p> Inscrivez vous et devenez un de nos membres Prenium </p>';
    echo '<h3><a href="user_space.php" class="label label-warning"> It\'s new and free! </a></h3>';
}
?>

        </div>
        </br>
        </br>

<?php
footer();
end_page();
?>
