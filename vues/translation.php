<?php
session_start();

function translation_body() { ?>
        <div class="container">
            <div class="page-header">
                <form class="form-inline" action="../translation-processing.php" method="get">
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
            <?php }



function avantages_prenium() {
    echo '</br><h3><a href="../ask_translation.php" class="label label-success">Vos avantages prenium</a><small> Détecter la langue d\'un mot / Demander une traduction /  Voir mon historique de demandes de traductions</small></h3>';
}

function standart() {
    echo '<p>Vous voulez détecter la langue d\'un mot ou encore demander une traduction ?</p>';
    echo '</br><p> Demandez à devenir un de nos membres Prenium a nos admins </p>';
    echo '<h3><a href="../about.php" class="label label-warning"> It\'s free! </a></h3>';
}

function pas_connecte() {
    echo '<p>Vous voulez détecter la langue d\'un mot ou encore demander une traduction ?</p>';
    echo '<p> Inscrivez vous et devenez un de nos membres Prenium </p>';
    echo '<h3><a href="../user_space.php" class="label label-warning"> It\'s new and free! </a></h3>';
}

