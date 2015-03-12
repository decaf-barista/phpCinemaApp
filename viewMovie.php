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
        <meta charset="UTF-8">
        <title></title>
        <link rel="stylesheet" type="text/css" href="style.css"><!--css-->
        <script type="text/javascript" src="js/screen.js"></script>
    </head>
    <body>
        <?php require 'toolbar.php' ?>
        <?php require 'header.php' ?>
        <?php require 'navbar.php' ?>`
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
                    . '<td>' . $row['genre'] . '</td>';
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
