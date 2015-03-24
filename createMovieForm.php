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
        <?php require 'styles.php' ?>
        <script type="text/javascript" src="js/movie.js"></script>  
    </head>
    <body>
        <?php require 'toolbar.php' ?>
        <?php require 'navbar.php' ?>

        <div class="window-bg">
            <div class="container">
                <div class="row window col-lg-10 col-lg-offset-1">
                    <form class="form col-lg-offset-2 col-lg-8" id="createMovieForm" action="createMovie.php"  method="POST"><!--submits data to be processed in CreateMovie(php validation)-->
                        <table border="0">
                            <tbody>
                                <tr><h1>Create Movie Form</h1></tr>
                            <tr>
                                <td><h3 class="col-lg-6">Title</h3></td>
                                <td class="col-lg-6">
                                    <input class="input" type="text" name="title" value="" /><br>
                                    <span id="titleError" class="error"><!--inside span elements the error messages will be displayed-->
                                        <?php
                                        if (isset($errorMessage) && isset($errorMessage['title'])) {
                                            echo $errorMessage['title'];
                                        }
                                        ?></span>
                                </td>
                            </tr>
                            <tr>
                                <td><h3 class="col-lg-6">Movie Year</h3></td>
                                <td class="col-lg-6">
                                    <input class="input" type="text" name="movieYear" value="" /><br>
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
                                <td><h3 class="col-lg-6">Run Time</h3></td>
                                <td class="col-lg-6">
                                    <input class="input" type="text" name="runTime" value="" /><br>
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
                                <td><h3 class="col-lg-6">Classification</h3></td>
                                <td class="col-lg-6">
                                    <input class="input" type="text" name="classification" value="" /><br>
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
                                <td><h3 class="col-lg-6">Director First Name</h3></td>
                                <td class="col-lg-6">
                                    <input class="input" type="text" name="directorFName" value="" /><br>
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
                                <td><h3 class="col-lg-6">Director Last Name</h3></td>
                                <td class="col-lg-6">
                                    <input class="input" type="text" name="directorLName" value="" /><br>
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
                                <td><h3 class="col-lg-6">Genre</h3></td>
                                <td class="col-lg-6">
                                    <select name="genre">
                                        <option value="-1">Unknown</option>
                                        <?php
                                        $g = $genres->fetch(PDO::FETCH_ASSOC);
                                        while ($g) {
                                            echo '<option value="' . $g['genreID'] . '">' . $g['genreName'] . '</option>';
                                            $g = $genres->fetch(PDO::FETCH_ASSOC);
                                        }
                                        ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input class="submit" type="submit" value="Create Movie" name="createMovie" />
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
