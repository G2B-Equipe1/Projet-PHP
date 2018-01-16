<?php
include 'util.php';
start_page();
set_gettext();
nav_bar();
?>

        <div class="container-fluid section">
            <section class="row">
                <article class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                    <img src="img/woman-writing-on-a-notebook.jpeg" class="img-fluid rounded" alt="Responsive image">
                </article>

                <article class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                    <p class="text-center">
                        <?php echo _('Presentation du site')?>
                    </p>
                </article>
            </section>
        </div>

        <div class="container-fluid section">
            <section class="row">
                <article class="col-xs-12 col-sm-4 col-md-64 col-lg-4">
                    <div class="article-img-overlay">
                        <img src="img/woman-writing-on-a-notebook.jpeg" class="img-fluid rounded" alt="Responsive image">
                        <div class="overlay">
                            <div class="text">Simplicité</div>
                        </div>
                    </div>
                </article>

                <article class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                    <div class="article-img-overlay">
                        <img src="img/woman-writing-on-a-notebook.jpeg" class="img-fluid rounded" alt="Responsive image">
                        <div class="overlay">
                            <div class="text">Rapidité</div>
                        </div>
                    </div>
                </article>

                <article class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                    <div class="article-img-overlay">
                        <img src="img/woman-writing-on-a-notebook.jpeg" class="img-fluid rounded" alt="Responsive image">
                        <div class="overlay">
                            <div class="text">Ecoute</div>
                        </div>
                    </div>
                </article>
            </section>
        </div>

        <div class="container-fluid section">
            <section class="row">
                <article class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                    <p class="text-center">
                        <?php echo _('Reseaux sociaux')?>
                    </p>
                </article>

                <article class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                    <img src="img/facebook-instagram-network-notebook.jpeg" class="img-fluid rounded" alt="Responsive image">
                </article>
            </section>
        </div>

<?php
    end_page();
?>

