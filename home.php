<?php
require_once 'Connection.php';
require_once 'MovieTableGateway.php';//need to call my table gateway classes because of my count functions
require_once 'ScreenTableGateway.php';
require_once 'GenreTableGateway.php';
require_once 'ReviewTableGateway.php';
require 'ensureUserLoggedIn.php';

$id = session_id();
if ($id == "") {
    session_start();
}

//setting up my connections
$connection = Connection::getInstance();
$movieGateway = new MovieTableGateway($connection);
$screenGateway = new ScreenTableGateway($connection);
$genreGateway = new GenreTableGateway($connection);
$reviewGateway = new ReviewTableGateway($connection);

//calling my statements
$statementMovie = $movieGateway->countMovies();
$statementScreen = $screenGateway->countScreens();
$statementGenre = $genreGateway->countGenres();
$statementReview = $reviewGateway->countReviews();
?>
<!DOCTYPE html>
<html>
    <head><!--calling everything inside my head inside the styles.php file so i don't have to change it if i need to-->
        <?php require 'styles.php' ?>
    </head>
    <body><!--calling toolbar and navbar so i don't have to copy the code-->
        <?php require 'toolbar.php' ?>
        <?php require 'navbar.php' ?>
        <?php
        if (isset($message)) {
            echo '<p>' . $message . '</p>';
        }
        ?><!--any error messages go here-->
        <div class="welcome-bg"><!--welcome colour bg-->
            <div class="container">
                <div class="welcome">
                    <img src="Images/profile.png" class="col-lg-1"><!--profile picture-->
                    <?php
                    echo '<h1>WELCOME ' . strtoupper($_SESSION['username']) . '</h1>';
                    ?><!--prints username in capital letters-->
                    <h4>YOU HAVE 0 NOTIFICATIONS</h4>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="home">  
                <div class="count col-lg-3">
                    <?php
                    $movieResult = $statementMovie->fetch();
                    $movieCount = $movieResult[0];
                    echo '<h1 class="home-count">' . $movieCount . '</h1>';
                    ?><!--prints the result of the count function-->
                    <p><a class="divLink" href="viewMovies.php">Movies in the system</a></p>
                </div>
                <div class="count col-lg-3">
                    <?php
                    $screenResult = $statementScreen->fetch();
                    $screenCount = $screenResult[0];
                    echo '<h1 class="home-count">' . $screenCount . '</h1>';
                    ?><!--prints the result of the count function-->
                    <p><a class="divLink" href="viewScreens.php">Screens in the system</a></p>
                </div>
                <div class="count col-lg-3">
                    <?php
                    $genreResult = $statementGenre->fetch();
                    $genreCount = $genreResult[0];
                    echo '<h1 class="home-count">' . $genreCount . '</h1>';
                    ?><!--prints the result of the count function-->
                    <p><a class="divLink" href="viewGenres.php">Genres in the system</a></p>
                </div>
                <div class="count col-lg-3">
                    <?php
                    $reviewResult = $statementReview->fetch();
                    $reviewCount = $reviewResult[0];
                    echo '<h1 class="home-count">' . $reviewCount . '</h1>';
                    ?><!--prints the result of the count function-->
                    <p><a class="divLink" href="viewReviews.php">Reviews in the system</a></p>
                </div>
            </div>
        </div>
    </div><!--calls my footer and the javascript at the end of the page to speed up the load time of my page-->
    <?php require 'footer.php' ?>
    <?php require 'scripts.php' ?>
</body>
</html>
