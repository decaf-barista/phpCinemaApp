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

$genres = $genreGateway->getGenres();
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
        <script type="text/javascript" src="js/movie.js"></script>
    </head>
    <body>
        <?php require 'toolbar.php' ?>
       
        <?php require 'navbar.php' ?>
        <h1>Create Screen Form</h1>
        
        <form id="editMovieForm" action="editMovie.php"  method="POST"><!--submits data to be processed in CreateMovie(php validation)-->
            <input type="hidden" name="movieID" value="<?php echo $movieID; ?>" />
            <table border="0">
                <tbody>
                    <tr>
                        <td>Title</td>
                        <td>
                            <input type="text" name="title" value="<?php
                                if (isset($_POST) && isset($_POST['title'])) {
                                    echo $_POST['title'];
                                }
                                else echo $movie['title'];
                            ?>" />
                            <span id="titleError" class="error"><!--inside span elements the error messages will be displayed-->
                                <?php
                                if (isset($errorMessage) && isset($errorMessage['title'])) {
                                    echo $errorMessage['title'];
                                }
                                ?></span>
                        </td>
                    </tr>
                    <tr>
                        <td>Movie Year</td>
                        <td>
                            <input type="text" name="movieYear" value="<?php
                                if (isset($_POST) && isset($_POST['movieYear'])) {
                                    echo $_POST['movieYear'];
                                }
                                else echo $movie['movieYear'];
                            ?>" />
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
                        <td>Run Time</td>
                        <td>
                            <input type="text" name="runTime" value="<?php
                                if (isset($_POST) && isset($_POST['runTime'])) {
                                    echo $_POST['runTime'];
                                }
                                else echo $movie['runTime'];
                            ?>" />
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
                        <td>Classification</td>
                        <td>
                            <input type="text" name="classification" value="<?php
                                if (isset($_POST) && isset($_POST['classification'])) {
                                    echo $_POST['classification'];
                                }
                                else echo $movie['classification'];
                            ?>" />
                            <span id="classificationError" class="error"><!--inside span elements the error messages will be displayed-->
                                <?php
                                if (isset($errorMessage) && isset($errorMessage['classification'])) {
                                    echo $errorMessage['classification'];
                                }
                                ?>
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td>Director First Name</td>
                        <td>
                            <input type="text" name="directorFName" value="<?php
                                if (isset($_POST) && isset($_POST['directorFName'])) {
                                    echo $_POST['directorFName'];
                                }
                                else echo $movie['directorFName'];
                            ?>" />
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
                        <td>Director Last Name</td>
                        <td>
                            <input type="text" name="directorLName" value="<?php
                                if (isset($_POST) && isset($_POST['directorLName'])) {
                                    echo $_POST['directorLName'];
                                }
                                else echo $movie['directorLName'];
                            ?>" />
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
                        <td>Genre</td>
                        <td>
                            <select name="genre">
                                <option value="-1">Unknown</option>
                                <?php
                                $g = $genres->fetch(PDO::FETCH_ASSOC);
                                while($g)
                                {
                                    $selected = "";
                                    if($g['genreID']==$movie['genre'])
                                    {
                                        $selected = "selected";
                                    }
                                    echo '<option value="'. $g['genreID'].'" ' . $selected. '>' .$g['genreName'] . '</option>';
                                    $g = $genres->fetch(PDO::FETCH_ASSOC);
                                }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="submit" value="Update Movie" name="updateMovie" />
                        </td>
                    </tr>
                </tbody>
            </table>

        </form>
        <?php require 'footer.php' ?>        
    </body>
</html>
