<?php
require_once 'Connection.php';
require_once 'GenreTableGateway.php';
require 'ensureUserLoggedIn.php';

$id = session_id();
if ($id == "") {
    session_start();
}

if (isset($_GET) && isset($_GET['sortOrder'])){
    $sortOrder =$_GET['sortOrder'];
    $columnNames = array("genreID", "genreName", "description");
    if(!in_array($sortOrder, $columnNames)){
        $sortOrder = 'genreID';
    }
}
else{
    $sortOrder = 'genreID';
}
$connection = Connection::getInstance();
$gateway = new GenreTableGateway($connection);

$statement = $gateway->getGenres($sortOrder);
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
                        <th><a href="viewGenres.php?sortOrder=genreID">Genre ID</a></th>
                        <th><a href="viewGenres.php?sortOrder=genreName">Genre Name</a></th>
                        <th><a href="viewGenres.php?sortOrder=description">Description</a></th>
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
