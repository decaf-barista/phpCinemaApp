<?php
$id = session_id();
if ($id == "") {
    session_start();
}
require 'ensureUserLoggedIn.php';
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
        <script type="text/javascript" src="js/genre.js"></script>
    </head>
    <body>
        <?php require 'toolbar.php' ?>
      
        <?php require 'navbar.php' ?>
        <h1>Create Genre Form</h1>
        
        <form id="createGenreForm" action="createGenre.php"  method="POST"><!--submits data to be processed in CreateGenre(php validation) and validateCreateGenre(js validation-->
            <table border="0">
                <tbody>
                    <tr>
                        <td>Genre Name</td>
                        <td>
                            <input type="text" name="genreName" value="" />
                            <span id="genreNameError" class="error"><!--inside span elements the error messages will be displayed-->
                                <?php
                                if (isset($errorMessage) && isset($errorMessage['genreName'])) {
                                    echo $errorMessage['genreName'];
                                }
                                ?></span>
                        </td>
                    </tr>
                    <tr>
                        <td>Description</td>
                        <td>
                            <input type="text" name="description" value="" />
                            <span id="descriptionError" class="error"><!--inside span elements the error messages will be displayed-->
                                <?php
                                if (isset($errorMessage) && isset($errorMessage['description'])) {
                                    echo $errorMessage['description'];
                                }
                                ?>
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="submit" value="Create Genre" name="createGenre" />
                        </td>
                    </tr>
                </tbody>
            </table>

        </form>
        <?php require 'footer.php' ?>        
    </body>
</html>