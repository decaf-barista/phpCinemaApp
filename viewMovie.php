<?php
//N00132070
require_once 'Connection.php';
require_once 'MovieTableGateway.php';

$id = session_id();
if ($id == "") {
    session_start();
}

require 'ensureUserLoggedIn.php';

if (!isset($_GET) || !isset($_GET['movieID'])) {
    die('Invalid request');
}
$movieID = $_GET['movieID'];

$connection = Connection::getInstance();
$gateway = new MovieTableGateway($connection);

$statement = $gateway->getMovieById($movieID);
?>
<!DOCTYPE html>
<html>
    <head>
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
        <script type="text/javascript" src="js/movie.js"></script>
    </head>
    </head>
    <body>
        <?php require 'toolbar.php' ?>
        
        <?php require 'navbar.php' ?>
        <?php
        if (isset($message)) {
        echo '<p>'.$message.'</p>';
        }
        ?>
        <div class="container">
        <table class="view col-lg-4 col-lg-offset-4">
            <tbody>
                <?php
                    $row = $statement->fetch(PDO::FETCH_ASSOC);
                    echo '<tr>';
                    echo '<td><p>Movie ID</p><br>' 
                    . '<span>' . $row['movieID'] . '</span></td>';
                    echo '</tr>';
                    echo '<tr>';
                    echo '<td><p>Title</p><br>' 
                    . '<span>' . $row['title'] . '</span></td>';
                    echo '</tr>';
                    echo '<tr>';
                    echo '<td><p>Movie Year</p><br>' 
                    . '<span>' . $row['movieYear'] . '</span></td>';
                    echo '</tr>';
                    echo '<tr>';
                    echo '<td><p>Run Time</p><br>' 
                    . '<span>' . $row['runTime'] . '</span></td>';
                    echo '</tr>';
                    echo '<tr>';
                    echo '<td><p>Classification</p><br>' 
                    . '<span><img src="Images/classifications/' . $row['classification'] . '.png" class="classification"></span></td>';
                    echo '</tr>';
                    echo '<tr>';
                    echo '<td><p>Director</p><br>' 
                    . '<span>' . $row['directorFName'] . ' ' . $row['directorLName'] .'</span></td>';
                    echo '</tr>';
                    echo '<tr>';
                    echo '<td><p>Genre</p><br>' 
                    . '<span>' . $row['genreName'] . '</span></td>';
                    echo '</tr>';
                ?>
            </tbody>
        </table>
        </div>
        <p><a href="editMovieForm.php?movieID=<?php echo $row['movieID']; ?>">
                Edit Movie</a>
            <a class="deleteMovie" href="deleteMovie.php?movieID=<?php echo $row['movieID']; ?>">
                Delete Movie</a>
        </p>
        <?php require 'footer.php' ?>
    </body>
</html>
