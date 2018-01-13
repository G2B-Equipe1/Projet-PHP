<?php
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
                        <label>E-mail : <input type="text" name="id"/></label>
                        <label>Mot de passe : <input type="password" name="mdp"/></label>
                        <input type="submit" name="action" value="Se connecter"/>
                    </form>
                </article>

                <article class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                    <p class="text-center">
                        <input type="submit" name="action" value="S'inscrire"/>
                </article>
            </section>
        </div>

        <?php
    }
    else
        {


            ?>
            <script type="text/javascript" src="js/functions.js"> </script>

            <h1>Votre espace perso :</h1><br>
            Votre email : <?php echo $_SESSION['mail'] ?><br>
            Votre pseudo : <?php echo $_SESSION['pseudo'] ?><br>
            Votre catégorie : <?php echo $_SESSION['categorie'] ?><br>
            <a href="#" onclick="toggleDisplay(changemdp);return false;" >Changer de mot de passe</a>
            <div id="changemdp" style="display:none;">
                <form action="data-processing.php" method="post">
                    <label>Mot de passe actuel : <input type="password" name="ancienmdp"/></label>
                    <label>Nouveau mot de passe : <input type="password" name="nouveaumdp"/></label>
                    <label>Répéter le nouveau mot de passe : <input type="password" name="confirmationmdp"/></label>
                    <input type="submit" name="action" value="Changer mot de passe">
                </form>
            </div>

            <p style="display:<?php
            if(isset($_SESSION['changesuccess']))
                echo $_SESSION['changesuccess'];
            else
                echo 'none';
            unset($_SESSION['changesuccess'])
            ?>;">
                Changement de mot de passe réussi
            </p>
            <p style="display:<?php
            if(isset($_SESSION['changefail1']))
                echo $_SESSION['changefail1'];
            else
                echo 'none';

            ?>;">
                <?php echo '<br>' . $_SESSION['changefail1'] . '<br>' ?>
                L'ancien mot de passe est incorrect.
            </p>
            <p style="display:<?php
            if(isset($_SESSION['changefail2']))
                echo $_SESSION['changefail2'];
            else
                echo 'none';
            ?>;">
                Le nouveau mot de passe et la confirmation ne correspondent pas.
            </p>
            <p style="display:<?php
            if(isset($_SESSION['Nomatch'])) // N'est jamais censé arriver
                echo $_SESSION['Nomatch'];
            else
                echo 'none';
            ?>;">
                Pas de correspondance dans la base de données. (debug)
            </p>

            <form action="data-processing.php" method="post" >
                <input type="submit" name="action" value="Se déconnecter">
            </form>
        <?php
    }
    end_page();
?>
