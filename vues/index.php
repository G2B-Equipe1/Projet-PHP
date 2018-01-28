<?php

function caroussel () { ?>
        <div id="myCarousel" class="carousel slide" data-ride="carousel">
            <!-- INDICATEUR CAROUSSEL -->
            <ol class="carousel-indicators">
                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                <li data-target="#myCarousel" data-slide-to="1"></li>
                <li data-target="#myCarousel" data-slide-to="2"></li>
            </ol>

            <!-- CAROUSSEL CONTENT -->
            <div class="carousel-inner" role="listbox">
                <div class="item active">
                    <img src="img/collaborative.jpeg" alt="Image">
                    <div class="carousel-caption">
                        <h3><?php echo _('Collaboratif')?></h3>
                        <p>
                            <?php echo _('Faite vous aidez de nos traducteurs pour vous aidez dans la rédaction de document.
                            Toujours à l\'écoute, ils vous donnerons des définitions adaptées a vos besoins dans les plus bref délai.
                            Nous somme toujours à l\'écoute pour n\'importe quel de vos problème de traduction')?>
                        </p>
                    </div>
                </div>

                <div class="item">
                    <img src="img/woman-writing-on-a-notebook.jpeg" alt="Image">
                    <div class="carousel-caption">
                        <h3><?php echo _('Simple')?></h3>
                        <p>
                            <?php echo _('Profitez d\'une interface simple et intuitive qui vous aidera dans n\'importe quel projet personnel comme professionnel.
                            Soyez plus rapide dans vos rédactions gràce à Virtuo Linguo et écrivez des documents de meilleur qualité grâce aux multiples définitions qui vous osnt données.')?>
                        </p>
                    </div>
                </div>

                <div class="item">
                    <img src="img/stock-iphone-business-mobile.jpeg" alt="Image">
                    <div class="carousel-caption">
                        <h3><?php echo _('Partout')?></h3>
                        <p>
                            <?php echo _('Notre site est 100% responsive et peut vous aidez n\'importe où que vous soyez et n\'importe quand pour peu que vous ayez une connexion internet.
                            Soyez sur que nous vous aiderons peu importe votre nationnalité et nous angageons a vous aidez dans n\'importe quelle circonstance.')?>
                        </p>
                    </div>
                </div>
            </div>

            <!-- CONTROLES CAROUSSEL -->
            <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
<?php }

function body() {?>
        <div class="container text-center">
            <h2><?php echo _('Nos service et nos offres')?></h2><br>
            <div class="row">
                <div class="col-sm-4">
                    <img src="img/user-you.jpeg" class="img-responsive img-rounded" style="width:100%" alt="Image">
                    <h3><?php echo _('Nos services')?></h3>
                </div>
                <div class="col-sm-4">
                    <img src="img/john-mee.jpg" class="img-responsive img-rounded" style="width:100%" alt="Image">
                    <h3><?php echo _('Vos avantages')?></h3>
                </div>
                <div class="col-sm-4">
                    <img src="img/helena-lopes.jpg" class="img-responsive img-rounded" style="width:100%" alt="Image">
                    <h3><?php echo _('Nos traducteurs')?></h3>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-4 align-self-center">
                    <div class="well">
                        <p>
                            <?php echo _('Nous vous proposons un service de recherche de traduction instantanée.
                            Vous pourrez voir toutes les traductions dans une langue donné qui sont disponnibles d\'un même mot.
                            Cela vous aidera dans la rédaction de vos document personnel comme professionnels.')?>
                        </p>
                    </div>
                    <div class="well">
                        <p>
                            <?php echo _('Inscrivez-vous sur notre site pour voir profiter de cette fonctionnalité à volontés.
                            Vous pourrez faire autant de recherche que vous le voulez sans contrainte de temps.
                            Quoi de mieux pour travailler plus sereinnement et ainsi améliorer votre efficacité au travail ?')?>
                        </p>
                    </div>
                </div>
                <div class="col-sm-4 align-self-center">
                    <div class="well">
                        <p>
                            <?php echo _('Nous vous proposons un service prenium qui vous garantira des résultat rapides et concret.
                            Une traduction d\'un mot n\'existe pas ou une des traductions proposées ne vous satisfait pas plainement ?
                            En tant qu\'utilisateur prenium vous pourrez demander une traduction d\'un mot a nos traducteur.
                            Ils vous proposeront une nouvelle definition dans les plus bref délais.')?>
                        </p>
                    </div>
                    <div class="well">
                        <p>
                            <?php echo _('Vous avez une vague idée d\'un mot que vous voulez utiliser mais ne connaissez pas précisément son orthographe?
                            Vous pourrez utiliser notre barre recherche par pertinence pour vus aider.
                            Mais encore si vous ne savez pas la langue d\'origine d\'un mot en particulier, vous pourrez l\'obtenir avec notre detecteur de langue.')?>
                        </p>
                    </div>
                </div>
                <div class="col-sm-4 align-self-center">
                    <div class="well">
                        <p>
                            <?php echo _('Notre équipe de traducteur reste à votre écoute 24h/24 et 7jours/7 pour répondre a toutes vos questions.
                            Ils pourront vous donner des traductions de mot en fonctions de vos demandes et modifier ou supprimer des définitions déjà existantes.')?>
                        </p>
                    </div>
                    <div class="well">
                        <p>
                            <?php echo _('Si les demandes de traductions sont trop répétitives ou encore trop incongru, vous pourrez recevoir un avertissement ou encore perdre votre status prenium.')?>
                        </p>
                    </div>
                </div>
            </div>
        </div><br>
<?php }


