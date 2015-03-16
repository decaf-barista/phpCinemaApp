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
        <meta charset="UTF-8">
        <title></title>
        <link rel="stylesheet" type="text/css" href="style.css">
        <script type="text/javascript" src="js/genre.js"></script>
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
