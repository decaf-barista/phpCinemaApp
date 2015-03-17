<?php
require_once 'Connection.php';
require_once 'GenreTableGateway.php';
require 'ensureUserLoggedIn.php';

$id = session_id();
if ($id == "") {
    session_start();
}

$connection = Connection::getInstance();
$gateway = new GenreTableGateway($connection);

$statement = $gateway->getGenres();
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
        <script type="text/javascript" src="js/genre.js"></script>
    </head>
    <body>
        <?php require 'toolbar.php' ?>
        <?php require 'navbar.php' ?>`
        <?php 
        if (isset($message)) {
            echo '<p>'.$message.'</p>';
        }
        ?>
        <table> <!--info table-->
            <thead>
                <tr>
                    <th>Genre ID</th>
                    <th>Genre Name</th>
                    <th>Description</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $row = $statement->fetch(PDO::FETCH_ASSOC);
                while ($row) {
                    echo '<tr>';//gets the info from createScreenForm and inputs it to the table//
                    echo '<td>' . $row['genreID'] . '</td>'; 
                    echo '<td>' . $row['genreName'] . '</td>';
                    echo '<td>' . $row['description'] . '</td>';
                    echo '<td>'
                    .'<a href="viewGenre.php?genreID=' .$row['genreID']. '">View</a> '
                    .'<a class="deleteGenre" href="deleteGenre.php?genreID=' .$row['genreID']. '">Delete</a> '
                    .'<a href="editGenreForm.php?genreID=' .$row['genreID']. '">Edit</a> '
                    . '</td>';
                    echo '</tr>';
                    
                    $row = $statement->fetch(PDO::FETCH_ASSOC);
                }
                ?>
            </tbody>
        </table>
        <p><a href="createGenreForm.php">Create Genre</a></p>
        <?php require 'footer.php' ?>
    </body>
</html>
