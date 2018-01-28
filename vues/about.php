<?php

function about_body () {?>
        <div class="container-fluid section">
            <section class="row">
                <article class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                    <div class="card">
                        <img src="https://image.noelshack.com/fichiers/2018/04/7/1517175474-half-dog.jpeg" class="img-fluid img-responsive img-rounded" alt="Responsive image">
                        <div class="about-crew-member">
                            <h2 class="about-name">Antonin GABORIAU</h2>
                            <h3 class="about-title"><?php echo _('Fondateur')?></h3>
                            <p> <?php echo _('Le meilleur ami du programmeur')?> </p>
                            <p><b>antonin.GABORIAU@etu.univ-amu.fr</b></p>
                        <form action="contact.php" method="post">
                            <input type="hidden" name="mail" value="antonin.GABORIAU@etu.univ-amu.fr"/>
                            <button class="btn btn-primary"  type="submit" name="action" value="Contact"><?php echo _('Contact')?></button>
                        </form>
                        </div>
                    </div>
                </article>

                <article class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                    <div class="card">
                        <img src="https://image.noelshack.com/fichiers/2018/04/7/1517175264-adorable-cat.jpeg" class="img-fluid img-responsive img-rounded" alt="Responsive image">
                        <div class="about-crew-member">
                            <h2 class="about-name">Yael HOARAU</h2>
                            <h3 class="about-title"><?php echo _('Fondateur')?></h3>
                            <p> <?php echo _('Discret mais efficace quand il veut')?></p>
                            <p><b>yael.hoarau@etu.univ-amu.fr</b></p>
                            <form action="contact.php" method="post">
                                <input type="hidden" name="mail" value="yael.hoarau@etu.univ-amu.fr"/>
                                <button class="btn btn-primary"  type="submit" name="action" value="Contact"><?php echo _('Contact')?></button>
                            </form>
                        </div>
                    </div>
                </article>

                <article class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                    <div class="card">
                        <img src="https://image.noelshack.com/fichiers/2018/04/7/1517175264-litle-piaf.jpeg" class="img-fluid img-responsive img-rounded" alt="Responsive image">
                        <div class="about-crew-member">
                            <h2 class="about-name">Romain GIUNTINI</h2>
                            <h3 class="about-title"><?php echo _('Fondateur')?></h3>
                            <p> <?php echo _('Un peu trop rapide et élégant')?> </p>
                            <p><b>romain.giuntini@etu.univ-amu.fr</b></p>
                            <form action="contact.php" method="post">
                                <input type="hidden" name="mail" value="romain.giuntini@etu.univ-amu.fr"/>
                                <button class="btn btn-primary" type="submit" name="action" value="Contact"><?php echo _('Contact')?></button>
                            </form>
                        </div>
                    </div>
                </article>
            </section>
            <section class="row">
                <article class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                    <div class="card">
                        <img src="https://image.noelshack.com/fichiers/2018/04/7/1517175343-little-hedgehog.jpeg" class="img-fluid img-responsive img-rounded" alt="Responsive image">
                        <div class="about-crew-member">
                            <h2 class="about-name">Adrien CROS</h2>
                            <h3 class="about-title"><?php echo _('Fondateur')?></h3>
                            <p> <?php echo _('Lent à la détente mais adorable')?> </p>
                            <p><b>adrien.cros.1@etu.univ-amu.fr</b></p>
                            <form action="contact.php" method="post">
                                <input type="hidden" name="mail" value="adrien.cros.1@etu.univ-amu.fr"/>
                                <button class="btn btn-primary" type="submit" name="action" value="Contact"><?php echo _('Contact')?></button>
                            </form>
                        </div>
                    </div>
                </article>

                <article class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                    <div class="card">
                        <img src="https://image.noelshack.com/fichiers/2018/04/7/1517175343-red-fish.jpeg" class="img-fluid img-responsive img-rounded" alt="Responsive image">
                        <div class="about-crew-member">
                            <h2 class="about-name">Romain COLONNA-DISTRIA</h2>
                            <h3 class="about-title"><?php echo _('Fondateur')?></h3>
                            <p> <?php echo _('Toujours là même quand il est pas là')?> </p>
                            <p><b>romain.COLONNA-DISTRIA@etu.univ-amu.fr</b></p>
                            <form action="contact.php" method="post">
                                <input type="hidden" name="mail" value="romain.COLONNA-DISTRIA@etu.univ-amu.fr"/>
                                <button class="btn btn-primary" type="submit" name="action" value="Contact"><?php echo _('Contact')?></button>
                            </form>
                        </div>
                    </div>
                </article>
            </section>
        </div>
<?php }
