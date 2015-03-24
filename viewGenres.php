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
        <?php require 'styles.php' ?>
        <script type="text/javascript" src="js/genre.js"></script>
    </head>
    <body>
        <?php require 'toolbar.php' ?>
        <?php require 'navbar.php' ?>`
        <?php
        if (isset($message)) {
            echo '<p>' . $message . '</p>';
        }
        ?>
        <div class="container">
            <a href="createGenreForm.php"><img src="Images/add.png" class="crud col-lg-offset-11 col-lg-1"></a>
            <table class="zui-table zui-table-horizontal zui-table-highlight col-lg-8 col-lg-offset-2"> <!--info table-->
                <thead>
                    <tr>
                        <th>Genre ID</th>
                        <th>Genre Name</th>
                        <th>Description</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $row = $statement->fetch(PDO::FETCH_ASSOC);
                    while ($row) {
                        echo '<tr>'; //gets the info from createScreenForm and inputs it to the table//
                        echo '<td>' . $row['genreID'] . '</td>';
                        echo '<td>' . $row['genreName'] . '</td>';
                        echo '<td>' . $row['description'] . '</td>';
                        echo '<td>'
                        . '<a href="viewGenre.php?genreID=' . $row['genreID'] . '"><img src="Images/view.png" class="crud"></a> '
                        . '<a class="deleteGenre" href="deleteGenre.php?genreID=' . $row['genreID'] . '"><img src="Images/delete.png" class="crud"></a> '
                        . '<a href="editGenreForm.php?genreID=' . $row['genreID'] . '"><img src="Images/edit.png" class="crud"></a> '
                        . '</td>';
                        echo '</tr>';

                        $row = $statement->fetch(PDO::FETCH_ASSOC);
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <?php require 'footer.php' ?>
        <?php require 'scripts.php' ?>
    </body>
</html>
