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
        <?php require 'styles.php' ?>
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
                    $movieResult = $statementMovie->fetch();
                    $movieCount = $movieResult[0];
                    echo '<h1 class="home-count">' . $movieCount . '</h1>';
                    ?>
                    <p><a class="divLink" href="viewMovies.php">Movies in the system</a></p>
                </div>
                <div class="count col-lg-3 col-lg-offset-1">
                    <?php
                    $screenResult = $statementScreen->fetch();
                    $screenCount = $screenResult[0];
                    echo '<h1 class="home-count">' . $screenCount . '</h1>';
                    ?>
                    <p><a class="divLink" href="viewScreens.php">Screens in the system</a></p>
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
    <?php require 'scripts.php' ?>
</body>
</html>
