<?php
require_once 'connection.php';
require_once 'GenreTableGateway.php';
require_once 'MovieTableGateway.php';
require 'ensureUserLoggedIn.php';

$id = session_id();
if ($id == "") {
    session_start();
}

if (!isset($_GET) || !isset($_GET['movieID'])) {
    die('Invalid request');
}
$movieID = $_GET['movieID'];

$conn = Connection::getInstance();
$movieGateway = new MovieTableGateway($conn);
$genreGateway = new GenreTableGateway($conn);

$movies = $movieGateway->getMovieById($movieID);
if ($movies->rowCount() !== 1) {
    die("Illegal request");
}
$movie = $movies->fetch(PDO::FETCH_ASSOC);

$sortOrder = 'genreID';
$genres = $genreGateway->getGenres($sortOrder);
?>
<!DOCTYPE html>
<html>
    <head>
        <?php require 'styles.php' ?>
        <script type="text/javascript" src="js/movie.js"></script>  
    </head>
    <body>
        <?php require 'toolbar.php' ?>
        <?php require 'navbar.php' ?>

        <div class="window-bg">
            <div class="container">
                <div class="row window col-lg-10 col-lg-offset-1">
                    <form class="form col-lg-offset-3 col-lg-6" id="editMovieForm" action="editMovie.php"  method="POST"><!--submits data to be processed in CreateMovie(php validation)-->
                        <input type="hidden" name="movieID" value="<?php echo $movieID; ?>" />
                        <table border="0">
                            <tbody>
                                <tr><h1 class="col-lg-10">Edit Movie Form</h1></tr>
                            <tr>
                                <td class="col-lg-6"><h3>Title</h3></td>
                                <td class="col-lg-6">
                                    <input class="input" type="text" name="title" value="<?php
                                    if (isset($_POST) && isset($_POST['title'])) {
                                        echo $_POST['title'];
                                    } else
                                        echo $movie['title'];
                                    ?>" /><br>
                                    <span id="titleError" class="error"><!--inside span elements the error messages will be displayed-->
                                        <?php
                                        if (isset($errorMessage) && isset($errorMessage['title'])) {
                                            echo $errorMessage['title'];
                                        }
                                        ?></span>
                                </td>
                            </tr>
                            <tr>
                                <td class="col-lg-6"><h3>Movie Year</h3></td>
                                <td class="col-lg-6">
                                    <input class="input" type="text" name="movieYear" value="<?php
                                    if (isset($_POST) && isset($_POST['movieYear'])) {
                                        echo $_POST['movieYear'];
                                    } else
                                        echo $movie['movieYear'];
                                    ?>" /><br>
                                    <span id="movieYearError" class="error"><!--inside span elements the error messages will be displayed-->
                                        <?php
                                        if (isset($errorMessage) && isset($errorMessage['movieYear'])) {
                                            echo $errorMessage['movieYear'];
                                        }
                                        ?>
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td class="col-lg-6"><h3>Run Time</h3></td>
                                <td class="col-lg-6">
                                    <input class="input" type="text" name="runTime" value="<?php
                                    if (isset($_POST) && isset($_POST['runTime'])) {
                                        echo $_POST['runTime'];
                                    } else
                                        echo $movie['runTime'];
                                    ?>" /><br>
                                    <span id="runTimeError" class="error"><!--inside span elements the error messages will be displayed-->
                                        <?php
                                        if (isset($errorMessage) && isset($errorMessage['runTime'])) {
                                            echo $errorMessage['runTime'];
                                        }
                                        ?>
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td class="col-lg-6"><h3>Classification</h3></td>
                                <td class="col-lg-6">
                                    <select name="classification">
                                        <?php
                                        $selected = "";
                                            if ($movie['classification']) {
                                                $selected = "selected";
                                            }
                                            echo '<option value="' . $movie['classification'] . '" ' . $selected . '>' . $movie['classification'] . '</option>';
                                        ?>
                                        <option value="-1">Unknown</option>
                                        <option value="12a">12a</option>
                                        <option value="15a">15a</option>
                                        <option value="18">18</option>
                                        <option value="Pg">PG</option>
                                        <option value="g">G</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td class="col-lg-6"><h3>Director First Name</h3></td>
                                <td class="col-lg-6">
                                    <input class="input" type="text" name="directorFName" value="<?php
                                    if (isset($_POST) && isset($_POST['directorFName'])) {
                                        echo $_POST['directorFName'];
                                    } else
                                        echo $movie['directorFName'];
                                    ?>" /><br>
                                    <span id="directorFNameError" class="error"><!--inside span elements the error messages will be displayed-->
                                        <?php
                                        if (isset($errorMessage) && isset($errorMessage['directorFName'])) {
                                            echo $errorMessage['directorFName'];
                                        }
                                        ?>
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td class="col-lg-6"><h3>Director Last Name</h3></td>
                                <td class="col-lg-6">
                                    <input class="input" type="text" name="directorLName" value="<?php
                                    if (isset($_POST) && isset($_POST['directorLName'])) {
                                        echo $_POST['directorLName'];
                                    } else
                                        echo $movie['directorLName'];
                                    ?>" /><br>
                                    <span id="directorLNameError" class="error"><!--inside span elements the error messages will be displayed-->
                                        <?php
                                        if (isset($errorMessage) && isset($errorMessage['directorLName'])) {
                                            echo $errorMessage['directorLName'];
                                        }
                                        ?>
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td class="col-lg-6"><h3>Genre</h3></td>
                                <td class="col-lg-6">
                                    <select name="genre">
                                        <option value="-1">Unknown</option>
                                        <?php
                                        $g = $genres->fetch(PDO::FETCH_ASSOC);
                                        while ($g) {
                                            $selected = "";
                                            if ($g['genreID'] == $movie['genre']) {
                                                $selected = "selected";
                                            }
                                            echo '<option value="' . $g['genreID'] . '" ' . $selected . '>' . $g['genreName'] . '</option>';
                                            $g = $genres->fetch(PDO::FETCH_ASSOC);
                                        }
                                        ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <input class="edit-submit" type="submit" value="Update Movie" name="updateMovie" />
                                </td>
                            </tr>
                            </tbody>
                        </table>

                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php require 'footer.php' ?> 
    <?php require 'scripts.php'; ?>
</body>
</html>
