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
        <table>
            <tbody>
                <?php
                    $row = $statement->fetch(PDO::FETCH_ASSOC);
                    echo '<tr>';
                    echo '<td>Movie ID</td>' 
                    . '<td>' . $row['movieID'] . '</td>';
                    echo '</tr>';
                    echo '<tr>';
                    echo '<td>Title</td>' 
                    . '<td>' . $row['title'] . '</td>';
                    echo '</tr>';
                    echo '<tr>';
                    echo '<td>Movie Year</td>' 
                    . '<td>' . $row['movieYear'] . '</td>';
                    echo '</tr>';
                    echo '<tr>';
                    echo '<td>Run Time</td>' 
                    . '<td>' . $row['runTime'] . '</td>';
                    echo '</tr>';
                    echo '<tr>';
                    echo '<td>Classification</td>' 
                    . '<td>' . $row['classification'] . '</td>';
                    echo '</tr>';
                    echo '<tr>';
                    echo '<td>Director First Name</td>' 
                    . '<td>' . $row['directorFName'] . '</td>';
                    echo '</tr>';
                    echo '<tr>';
                    echo '<td>Director Last Name</td>' 
                    . '<td>' . $row['directorLName'] . '</td>';
                    echo '</tr>';
                    echo '<tr>';
                    echo '<td>Genre</td>' 
                    . '<td>' . $row['genreName'] . '</td>';
                    echo '</tr>';
                ?>
            </tbody>
        </table>
        <p><a href="editMovieForm.php?movieID=<?php echo $row['movieID']; ?>">
                Edit Movie</a>
            <a class="deleteMovie" href="deleteMovie.php?movieID=<?php echo $row['movieID']; ?>">
                Delete Movie</a>
        </p>
        <?php require 'footer.php' ?>
    </body>
</html>
