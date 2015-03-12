<?php
require_once 'connection.php';
require_once 'GenreTableGateway.php';
$id = session_id();
if ($id == "") {
    session_start();
}

require 'ensureUserLoggedIn.php';
$conn = Connection::getInstance();
$genreGateway = new GenreTableGateway($conn);


$genres = $genreGateway->getGenres();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link rel="stylesheet" type="text/css" href="style.css"><!--css-->
        <script type="text/javascript" src="js/movie.js"></script><!--javascript validation-->
    </head>
    <body>
        <?php require 'toolbar.php' ?>
        <?php require 'header.php' ?>
        <?php require 'navbar.php' ?>`
        <h1>Create Screen Form</h1>
        
        <form id="createMovieForm" action="createMovie.php"  method="POST"><!--submits data to be processed in CreateMovie(php validation)-->
            <table border="0">
                <tbody>
                    <tr>
                        <td>Title</td>
                        <td>
                            <input type="text" name="title" value="" />
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
                            <input type="text" name="movieYear" value="" />
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
                            <input type="text" name="runTime" value="" />
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
                            <input type="text" name="classification" value="" />
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
                            <input type="text" name="directorFName" value="" />
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
                            <input type="text" name="directorLName" value="" />
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
                                    echo '<option value="'. $g['genreName'].'">' .$g['genreName'] . '</option>';
                                    $g = $genres->fetch(PDO::FETCH_ASSOC);
                                }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="submit" value="Create Movie" name="createMovie" />
                        </td>
                    </tr>
                </tbody>
            </table>

        </form>
        <?php require 'footer.php' ?>        
    </body>
</html>
