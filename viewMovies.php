<?php
require_once 'Connection.php';
require_once 'MovieTableGateway.php';
require 'ensureUserLoggedIn.php';

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
        <meta charset="UTF-8">
        <title></title>
        <link rel="stylesheet" type="text/css" href="style.css">
        <!--<script type="text/javascript" src="js/screen.js"></script>-->
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
        <table> <!--info table-->
            <thead>
                <tr>
                    <th>Movie ID</th>
                    <th>Title</th>
                    <th>Movie Year</th>
                    <th>Run Time</th>
                    <th>Classification</th>
                    <th>Director First Name</th>
                    <th>Director Last Name</th>
                    <th>Genre</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $row = $statement->fetch(PDO::FETCH_ASSOC);
                while ($row) {
                    echo '<tr>';//gets the info from createMovieForm and inputs it to the table// 
                    echo '<td>' . $row['movieID'] . '</td>';
                    echo '<td>' . $row['title'] . '</td>';
                    echo '<td>' . $row['movieYear'] . '</td>';
                    echo '<td>' . $row['runTime'] . '</td>';
                    echo '<td>' . $row['classification'] . '</td>';
                    echo '<td>' . $row['directorFName'] . '</td>';
                    echo '<td>' . $row['directorLName'] . '</td>';
                    echo '<td>' . $row['genre'] . '</td>';
                    echo '<td>'
                    .'<a href="viewMovie.php?movieID=' .$row['movieID']. '">View</a> '
                    .'<a class="deleteMovie" href="deleteMovie.php?movieID=' .$row['movieID']. '">Delete</a> '
                    .'<a href="editMovieForm.php?movieID=' .$row['movieID']. '">Edit</a> '
                    . '</td>';
                    echo '</tr>';
                    
                    $row = $statement->fetch(PDO::FETCH_ASSOC);
                }
                ?>
            </tbody>
        </table>
        <p><a href="createMovieForm.php">Create Movie</a></p>
        <?php require 'footer.php' ?>
    </body>
</html>
