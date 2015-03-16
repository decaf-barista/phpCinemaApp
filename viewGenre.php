<?php
//N00132070
require_once 'Connection.php';
require_once 'GenreTableGateway.php';

$id = session_id();
if ($id == "") {
    session_start();
}

require 'ensureUserLoggedIn.php';

if (!isset($_GET) || !isset($_GET['genreID'])) {
    die('Invalid request');
}
$genreID = $_GET['genreID'];

$connection = Connection::getInstance();
$gateway = new GenreTableGateway($connection);

$statement = $gateway->getGenreByID($genreID);
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link rel="stylesheet" type="text/css" href="style.css"><!--css-->
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
        <table>
            <tbody>
                <?php
                    $row = $statement->fetch(PDO::FETCH_ASSOC);
                    echo '<tr>';
                    echo '<td>Genre ID</td>' 
                    . '<td>' . $row['genreID'] . '</td>';
                    echo '</tr>';
                    echo '<tr>';
                    echo '<td>Genre Name</td>' 
                    . '<td>' . $row['genreName'] . '</td>';
                    echo '</tr>';
                    echo '<tr>';
                    echo '<td>Description</td>' 
                    . '<td>' . $row['description'] . '</td>';
                    echo '</tr>';
                ?>
            </tbody>
        </table>
        <p><a href="editGenreForm.php?genreID=<?php echo $row['genreID']; ?>">
                Edit Genre</a>
            <a class="deleteGenre" href="deleteGenre.php?genreID=<?php echo $row['genreID']; ?>">
                Delete Genre</a>
        </p>
        <?php require 'footer.php' ?>
    </body>
</html>
