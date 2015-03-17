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
        <meta charset="UTF-8">
        <title></title>
        <link rel="stylesheet" type="text/css" href="custom.css"><!--css-->
        <script type="text/javascript" src="js/genre.js"></script><!--javascript validation-->
    </head>
    <body>
        <?php require 'toolbar.php' ?>
        <?php require 'header.php' ?>
        <?php require 'navbar.php' ?>`
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