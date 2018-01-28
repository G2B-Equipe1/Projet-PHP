<?php

function coaroussel () { ?>
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
                    <img src="../img/facebook-instagram-network-notebook.jpeg" alt="Image">
                    <div class="carousel-caption">
                        <h3><?php echo _('Collaborative')?></h3>
                        <p>Ego vero sic intellego, Patres conscripti, nos hoc tempore in provinciis decernendis perpetuae pacis habere oportere rationem. Nam quis hoc non sentit omnia alia esse nobis vacua ab omni periculo atque etiam suspicione belli?</p>
                    </div>
                </div>

                <div class="item">
                    <img src="../img/woman-writing-on-a-notebook.jpeg" alt="Image">
                    <div class="carousel-caption">
                        <h3><?php echo _('Simple')?></h3>
                        <p>Ego vero sic intellego, Patres conscripti, nos hoc tempore in provinciis decernendis perpetuae pacis habere oportere rationem. Nam quis hoc non sentit omnia alia esse nobis vacua ab omni periculo atque etiam suspicione belli?</p>
                    </div>
                </div>

                <div class="item">
                    <img src="../img/stock-iphone-business-mobile.jpeg" alt="Image">
                    <div class="carousel-caption">
                        <h3><?php echo _('Everywhere')?></h3>
                        <p>Ego vero sic intellego, Patres conscripti, nos hoc tempore in provinciis decernendis perpetuae pacis habere oportere rationem. Nam quis hoc non sentit omnia alia esse nobis vacua ab omni periculo atque etiam suspicione belli?</p>
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
            <h2><?php echo _('wtf')?></h2><br>
            <div class="row">
                <div class="col-sm-4">
                    <img src="../img/facebook-instagram-network-notebook.jpeg" class="img-responsive img-rounded" style="width:100%" alt="Image">
                    <h3>Lorem ipsum</h3>
                </div>
                <div class="col-sm-4">
                    <img src="../img/woman-writing-on-a-notebook.jpeg" class="img-responsive img-rounded" style="width:100%" alt="Image">
                    <h3>Lorem ipsum</h3>
                </div>
                <div class="col-sm-4">
                    <img src="../img/stock-iphone-business-mobile.jpeg" class="img-responsive img-runded" style="width:100%" alt="Image">
                    <h3>Lorem Ipsum</h3>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-4 align-self-center">
                    <div class="well">
                        <p>Ego vero sic intellego, Patres conscripti, nos hoc tempore in provinciis decernendis perpetuae pacis habere oportere rationem. Nam quis hoc non sentit omnia alia esse nobis vacua ab omni periculo atque etiam suspicione belli?</p>
                    </div>
                    <div class="well">
                        <p>Ego vero sic intellego, Patres conscripti, nos hoc tempore in provinciis decernendis perpetuae pacis habere oportere rationem. Nam quis hoc non sentit omnia alia esse nobis vacua ab omni periculo atque etiam suspicione belli?</p>
                    </div>
                </div>
                <div class="col-sm-4 align-self-center">
                    <div class="well">
                        <p>Ego vero sic intellego, Patres conscripti, nos hoc tempore in provinciis decernendis perpetuae pacis habere oportere rationem. Nam quis hoc non sentit omnia alia esse nobis vacua ab omni periculo atque etiam suspicione belli?</p>
                    </div>
                    <div class="well">
                        <p>Ego vero sic intellego, Patres conscripti, nos hoc tempore in provinciis decernendis perpetuae pacis habere oportere rationem. Nam quis hoc non sentit omnia alia esse nobis vacua ab omni periculo atque etiam suspicione belli?</p>
                    </div>
                </div>
                <div class="col-sm-4 align-self-center">
                    <div class="well">
                        <p>Ego vero sic intellego, Patres conscripti, nos hoc tempore in provinciis decernendis perpetuae pacis habere oportere rationem. Nam quis hoc non sentit omnia alia esse nobis vacua ab omni periculo atque etiam suspicione belli?</p>
                    </div>
                    <div class="well">
                        <p>Ego vero sic intellego, Patres conscripti, nos hoc tempore in provinciis decernendis perpetuae pacis habere oportere rationem. Nam quis hoc non sentit omnia alia esse nobis vacua ab omni periculo atque etiam suspicione belli?</p>
                    </div>
                </div>
            </div>
        </div><br>
<?php }


