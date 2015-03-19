<?php
require_once 'Connection.php';
require_once 'MovieTableGateway.php';
require_once 'ScreenTableGateway.php';
require_once 'GenreTableGateway.php';
require 'ensureUserLoggedIn.php';

$id = session_id();
if ($id == "") {
    session_start();
}

$connection = Connection::getInstance();
$movieGateway = new MovieTableGateway($connection);
$screenGateway = new ScreenTableGateway($connection);
$genreGateway = new GenreTableGateway($connection);

$statementMovie = $movieGateway->countMovies();
$statementScreen = $screenGateway->countScreens();
$statementGenre = $genreGateway->countGenres();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset = "utf-8"><!--lets my browser read and display characters-->
        <meta name="viewport" content="width=device-width initial-scale=1.0"><!--will scale for the different with of pages-->
        <!--linking stylesheets-->
        <link href="css/bootstrap.min.css" rel="stylesheet"><!--using .min so it will be faster, framework style sheet-->
        <link href="css/custom.css" rel="stylesheet"><!--my own css file-->
        <link href='http://fonts.googleapis.com/css?family=Ubuntu+Condensed' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Ubuntu:700' rel='stylesheet' type='text/css'>
        <link rel="shortcut icon" href="images/oscars.png"/>
        <script src="js/respond.min.js"></script><!--what we downloaded from github needs to be in the head! otherwise not reposive-->
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
        <title>TAKE TWO</title>
    </head>
    <body>
        <?php require 'toolbar.php' ?>
        <?php require 'navbar.php' ?>
        <?php
        if (isset($message)) {
            echo '<p>' . $message . '</p>';
        }
        ?>
        <div class="welcome-bg">    
            <div class="container">
                <div class="welcome">
                    <img src="Images/profile.png" class="col-lg-1">
                    <?php
                    echo '<h1>WELCOME ' . strtoupper($_SESSION['username']) . '</h1>';
                    ?>
                    <h4>YOU HAVE 0 NOTIFICATIONS</h4>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="home">
                <div class="count col-lg-3">
                    <?php
                    $screenResult = $statementScreen->fetch();
                    $screenCount = $screenResult[0];
                    echo '<h1 class="home-count">' . $screenCount . '</h1>';
                    ?>
                    <p><a class="divLink" href="viewScreens.php">Screens in the system</a></p>
                </div>
                <div class="count col-lg-offset-1 col-lg-3">
                    <?php
                    $movieResult = $statementMovie->fetch();
                    $movieCount = $movieResult[0];
                    echo '<h1 class="home-count">' . $movieCount . '</h1>';
                    ?>
                    <p><a class="divLink" href="viewMovies.php">Movies in the system</a></p>
                </div>
                <div class="count col-lg-offset-1 col-lg-3">
                    <?php
                    $genreResult = $statementGenre->fetch();
                    $genreCount = $genreResult[0];
                    echo '<h1 class="home-count">' . $genreCount . '</h1>';
                    ?>
                    <p><a class="divLink" href="viewGenres.php">Genres in the system</a></p>
                </div>
            </div>
        </div>
    </div>
    <?php require 'footer.php' ?>
</body>
</html>
