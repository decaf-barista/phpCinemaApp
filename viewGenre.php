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
        <?php require 'styles.php' ?>
        <script type="text/javascript" src="js/genre.js"></script>
    </head>
    <body>
        <?php require 'toolbar.php' ?>

        <?php require 'navbar.php' ?>
        <?php
        if (isset($message)) {
            echo '<p>' . $message . '</p>';
        }
        $row = $statement->fetch(PDO::FETCH_ASSOC);
        ?><div class="container">
            <p class="col-lg-3 col-lg-offset-7">
                <a href="editGenreForm.php?genreID=<?php echo $row['genreID']; ?>"><img src="Images/edit.png" class="crud"></a>
                <a class="deleteGenre" href="deleteGenre.php?genreID=<?php echo $row['genreID']; ?>"><img src="Images/delete.png" class="crud"></a>
            </p>
            <table class="view col-lg-4 col-lg-offset-4">
                <tbody>
                    <?php
                    echo '<tr>';
                    echo '<td><p>Genre ID</p><br>'
                    . '<span>' . $row['genreID'] . '</span></td>';
                    echo '</tr>';
                    echo '<tr>';
                    echo '<td><p>Genre Name</p><br>'
                    . '<span>' . $row['genreName'] . '</span></td>';
                    echo '</tr>';
                    echo '<tr>';
                    echo '<td><p>Description</p><br>'
                    . '<span>' . $row['description'] . '</span></td>';
                    echo '</tr>';
                    ?>
                </tbody>
            </table>
        </div>
        <?php require 'footer.php' ?>
        <?php require 'scripts.php' ?>
    </body>
</html>
