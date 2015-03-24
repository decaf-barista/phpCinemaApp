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
    <head>
        <?php require 'styles.php' ?>
        <script type="text/javascript" src="js/movie.js"></script>
    </head>
</head>
<body>
    <?php require 'toolbar.php' ?>
    <?php require 'navbar.php' ?>
    <?php
    if (isset($message)) {
        echo '<p>' . $message . '</p>';
    }
    $row = $statement->fetch(PDO::FETCH_ASSOC);
    ?>
    <div class="container">
        <p class="col-lg-3 col-lg-offset-7">
            <a href="editMovieForm.php?movieID=<?php echo $row['movieID']; ?>"><img src="Images/edit.png" class="crud"></a>
            <a class="deleteMovie" href="deleteMovie.php?movieID=<?php echo $row['movieID']; ?>"><img src="Images/delete.png" class="crud"></a>
        </p>
        <table class="view col-lg-4 col-lg-offset-4">
            <tbody>
                <?php
                echo '<tr>';
                echo '<td><p>Movie ID</p><br>'
                . '<span>' . $row['movieID'] . '</span></td>';
                echo '</tr>';
                echo '<tr>';
                echo '<td><p>Title</p><br>'
                . '<span>' . $row['title'] . '</span></td>';
                echo '</tr>';
                echo '<tr>';
                echo '<td><p>Movie Year</p><br>'
                . '<span>' . $row['movieYear'] . '</span></td>';
                echo '</tr>';
                echo '<tr>';
                echo '<td><p>Run Time</p><br>'
                . '<span>' . $row['runTime'] . '</span></td>';
                echo '</tr>';
                echo '<tr>';
                echo '<td><p>Classification</p><br>'
                . '<span><img src="Images/classifications/' . $row['classification'] . '.png" class="classification"></span></td>';
                echo '</tr>';
                echo '<tr>';
                echo '<td><p>Director</p><br>'
                . '<span>' . $row['directorFName'] . ' ' . $row['directorLName'] . '</span></td>';
                echo '</tr>';
                echo '<tr>';
                echo '<td><p>Genre</p><br>'
                . '<span>' . $row['genreName'] . '</span></td>';
                echo '</tr>';
                ?>
            </tbody>
        </table>
    </div>
    <?php require 'footer.php' ?>
    <?php require 'scripts.php' ?>
</body>
</html>
