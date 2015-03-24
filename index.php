<?php
require_once 'Connection.php';
require_once 'MovieTableGateway.php';


$id = session_id();
if ($id == "") {
    session_start();
}

$connection = Connection::getInstance();
$gateway = new MovieTableGateway($connection);

$statement = $gateway->getMovies();
?>
<!DOCTYPE html>
<html>
    <head>
        <?php require 'styles.php' ?>
    </head>
    <body>
        <?php require 'toolbar.php' ?>
        <?php require 'navbar.php' ?>
        <div class="row">
            <div class="jumbotron">
                <img src="Images/carousel lg images.png" class="img-responsive">
            </div>
        </div>
        <div class="main">
            <div class="main_showing">
                <div class="container">
                    <div class="row">
                        <div id="now_showing" class="col-lg-12">
                            <h2>NOW SHOWING</h2>
                            <p>Check back every week for new times and new movies.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="main_movies">
                <div class="container">
                    <div class="row">
                        <div class="col1 col-lg-offset-1 col-lg-3 col-md-offset-1 col-md-3 col-sm-4 col-xs-4">
                            <div class="movie_poster">
                                <img src="Images/poster_images/american_sniper.jpg" class="img-responsive"><br>
                                <!--<div class="movie_text">
                                        <h3>American Sniper</h3>
                                </div>-->
                            </div>
                            <p class="ticket">BUY TICKETS</p>

                        </div>
                        <div class="col2 col-lg-offset-1 col-lg-3 col-md-offset-1 col-md-3 col-sm-4 col-xs-4">
                            <img src="Images/poster_images/big_hero_6.jpg"class="img-responsive"><br>
                            <p class="ticket">BUY TICKETS</p>
                        </div>
                        <div class="col3 col-lg-offset-1 col-lg-3 col-md-offset-1 col-md-3 col-sm-4 col-xs-4">
                            <img src="Images/poster_images/fifty_shades.jpg" class="img-responsive"><br>
                            <p class="ticket">BUY TICKETS</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col1 col-lg-offset-1 col-lg-3 col-md-offset-1 col-md-3 col-sm-4 col-xs-4">
                            <img src="Images/poster_images/jupiter.jpg" class="img-responsive"><br>
                            <p class="ticket">BUY TICKETS</p>
                        </div>
                        <div class="col2 col-lg-offset-1 col-lg-3 col-md-offset-1 col-md-3 col-sm-4 col-xs-4">
                            <img src="Images/poster_images/kingsman.jpg"class="img-responsive"><br>
                            <p class="ticket">BUY TICKETS</p>
                        </div>
                        <div class="col3 col-lg-offset-1 col-lg-3 col-md-offset-1 col-md-3 col-sm-4 col-xs-4">
                            <img src="Images/poster_images/marigold_hotel.jpg" class="img-responsive"><br>
                            <p class="ticket">BUY TICKETS</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col1 col-lg-offset-1 col-lg-3 col-md-offset-1 col-md-3 col-sm-4 col-xs-4">
                            <img src="Images/poster_images/selma.jpg" class="img-responsive"><br>
                            <p class="ticket">BUY TICKETS</p>
                        </div>
                        <div class="col2 col-lg-offset-1 col-lg-3 col-md-offset-1 col-md-3 col-sm-4 col-xs-4">
                            <img src="Images/poster_images/still_alice.jpg"class="img-responsive"><br>
                            <p class="ticket">BUY TICKETS</p>
                        </div>
                        <div class="col3 col-lg-offset-1 col-lg-3 col-md-offset-1 col-md-3 col-sm-4 col-xs-4">
                            <img src="Images/poster_images/theory.jpg" class="img-responsive"><br>
                            <p class="ticket">BUY TICKETS</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php require 'footer.php' ?>
        <?php require 'scripts.php' ?>
    </body>
</html>
