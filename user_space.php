<?php
    if(isset($_COOKIE['confirmail']))
    {
        header('Location: activate.php');
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
                        <label>E-mail : <input type="text" name="id"/></label>
                        <label>Mot de passe : <input type="password" name="mdp"/></label>
                        <input type="submit" name="action" value="Se connecter"/>
                    </form>
                    </p>
                    <p style="display:<?php echo isset($_SESSION['connexionfailed']) ? '' : 'none';
                    unset($_SESSION['connexionfailed']) ?>;">
                        Le mail et/ou le mot de passe est incorrect.
                    </p>
                </article>

                <article class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                    <form action="data-processing.php" method="post">
                        <label>Pseudo : <input type="text" name="pseudo"/></label>
                        <label>E-mail : <input type="text" name="mail"/></label>
                        <label>Mot de passe : <input type="password" name="mdp"/></label>
                        <label>Confirmer mot de passe : <input type="password" name="confirmationmdp"/></label>
                        <input type="submit" name="action" value="S'inscrire"/>
                    </form>

                    <p style="display:<?php echo isset($_SESSION['mailpris']) ? '' : 'none';
                    unset($_SESSION['mailpris']) ?>;">
                        Cet email n'est pas conforme ou est déjà utilisé sur le site.
                    </p>

                    <p style="display:<?php echo isset($_SESSION['pseudopris']) ? '' : 'none';
                    unset($_SESSION['pseudopris']) ?>;">
                        Ce pseudo est déjà pris par un autre utilisateur.
                    </p>

                    <p style="display:<?php echo isset($_SESSION['mauvaismdp']) ? '' : 'none';
                    unset($_SESSION['mauvaismdp']) ?>;">
                        Le mot de passe et la confirmation ne correspondent pas.
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
                Bienvenue sur notre site ! <br>
            </p>

            <h1>Votre espace perso :</h1><br>
            Votre email : <?php echo $_SESSION['mail'] ?><br>
            Votre pseudo : <?php echo $_SESSION['pseudo'] ?><br>
            Votre catégorie : <?php echo $_SESSION['categorie'] ?><br>
            Changer de catégorie : <br>
            <form action="data-processing.php" method="post">
                <input type="submit" name="action" value="Passer en standard">
                <input type="submit" name="action" value="Passer en premium">
                <input type="submit" name="action" value="Passer en traducteur">
                <input type="submit" name="action" value="Passer en administrateur">
            </form>

            <button href="#" onclick="toggleDisplay(changemdp);return false;" >Changer de mot de passe</button>
            <div id="changemdp" style="display:none;">
                <form action="data-processing.php" method="post">
                    <label>Mot de passe actuel : <input type="password" name="ancienmdp"/></label>
                    <label>Nouveau mot de passe : <input type="password" name="nouveaumdp"/></label>
                    <label>Répéter le nouveau mot de passe : <input type="password" name="confirmationmdp"/></label>
                    <input type="submit" name="action" value="Changer mot de passe">
                </form>
            </div>

            <p style="display:<?php echo isset($_SESSION['changesuccess']) ? '' : 'none';
                                unset($_SESSION['changesuccess']) ?>;">
                Changement de mot de passe réussi
            </p>
            <p style="display:<?php echo isset($_SESSION['changefail1']) ? '' : 'none';
            unset($_SESSION['changefail1']) ?>;">
                L'ancien mot de passe est incorrect.
            </p>
            <p style="display:<?php echo isset($_SESSION['changefail2']) ? '' : 'none';
            unset($_SESSION['changefail2']) ?>;">
                Le nouveau mot de passe et la confirmation ne correspondent pas.
            </p>

            <form action="data-processing.php" method="post" >
                <input type="submit" name="action" value="Se déconnecter">
            </form>

            <button href="#" onclick="toggleDisplay(supprcompte);return false;" >Supprimer mon compte</button>
            <div id="supprcompte" style="display:<?php echo isset($_SESSION['wrongmdp']) ? '' : 'none'; ?>;">
                <form action="data-processing.php" method="post">
                    <label>Veuillez entrer votre mot de passe actuel : <input type="password" name="mdp"/></label>

                    <p style="display:<?php echo isset($_SESSION['wrongmdp']) ? '' : 'none';
                    unset($_SESSION['wrongmdp']) ?>;">
                        Le mot de passe est incorrect.
                    </p>

                    <br>Attention, cette opération est irréversible,
                    la suppression du compte et de ses données est définitive.
                    <input type="submit" name="action" value="Confirmer la suppression du compte">
                </form>
            </div>
        <?php
    }
    end_page();
?>
