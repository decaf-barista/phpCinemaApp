<?php
require_once 'Connection.php';
require_once 'MovieTableGateway.php';
require_once 'GenreTableGateway.php';
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
        <?php require 'styles.php' ?>
        <script type="text/javascript" src="js/movie.js"></script>
    </head>
    <body>
        <?php require 'toolbar.php' ?>
        <?php require 'navbar.php' ?>`
        <?php 
        if (isset($message)) {
            echo '<p>'.$message.'</p>';
        }
        ?>
        <div class="container">
            <a href="createMovieForm.php"><img src="Images/add.png" class="crud col-lg-offset-11 col-lg-1"></a>
            <table class="zui-table zui-table-horizontal zui-table-highlight col-lg-12"> <!--info table-->
                <thead>
                <tr>
                    <th>Movie ID</th>
                    <th>Title</th>
                    <th>Movie Year</th>
                    <th>Run Time</th>
                    <th>Classification</th>
                    <th>Director</th>
                    <th>Genre</th>
                    <th></th>
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
                    echo '<td><img src="Images/classifications/' . $row['classification'] . '.png" class="classification"></td>';
                    echo '<td>' . $row['directorFName'] . ' ' . $row['directorLName'] .'</td>';
                    echo '<td>' . $row['genreName'] . '</td>';
                    echo '<td>'
                    . '<a href="viewMovie.php?movieID=' . $row['movieID'] . '"><img src="Images/view.png" class="crud"></a> '
                    . '<a class="deleteMovie" href="deleteMovie.php?movieID=' . $row['movieID'] . '"><img src="Images/delete.png" class="crud"></a> '
                    . '<a href="editMovieForm.php?movieID=' . $row['movieID'] . '"><img src="Images/edit.png" class="crud"></a> '
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
