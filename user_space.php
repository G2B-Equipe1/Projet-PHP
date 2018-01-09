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
                        <label>Mot de passe : <input type="text" name="mdp"/></label>
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

            Vous êtes connecté !

        <?php
    }
    end_page();
?>
