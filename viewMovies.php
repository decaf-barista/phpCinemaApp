<?php
require_once 'Connection.php';
require_once 'MovieTableGateway.php';
require_once 'GenreTableGateway.php';
require 'ensureUserLoggedIn.php';

$id = session_id();
if ($id == "") {
    session_start();
}

if (isset($_GET) && isset($_GET['sortOrder'])){
    $sortOrder =$_GET['sortOrder'];
    $columnNames = array("movieID", "title", "movieYear", "runTime", "classification", "directorLName", "genre");
    if(!in_array($sortOrder, $columnNames)){
        $sortOrder = 'movieID';
    }
}
else{
    $sortOrder = 'movieID';
}

$connection = Connection::getInstance();
$gateway = new MovieTableGateway($connection);

$statement = $gateway->getMovies($sortOrder);
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
                    <th><a href="viewMovies.php?sortOrder=movieID">Movie ID</a></th>
                    <th><a href="viewMovies.php?sortOrder=title">Title</a></th>
                    <th><a href="viewMovies.php?sortOrder=movieYear">Movie Year</a></th>
                    <th><a href="viewMovies.php?sortOrder=runTime">Run Time</a></th>
                    <th><a href="viewMovies.php?sortOrder=classification">Classification</a></th>
                    <th><a href="viewMovies.php?sortOrder=directorLName">Director</a></th>
                    <th><a href="viewMovies.php?sortOrder=genre">Genre</a></th>
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
