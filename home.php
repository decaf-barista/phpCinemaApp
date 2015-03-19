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
            echo '<p>'.$message.'</p>';
        }
        ?>
        <?php
        echo $statementMovie;
        echo'<p>Amount of movies in the system'
        ?>
        <?php require 'footer.php' ?>
    </body>
</html>
