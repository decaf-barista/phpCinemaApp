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
        <?php require 'styles.php' ?>
        <script type="text/javascript" src="js/genre.js"></script>
    </head>
    <body>
        <?php require 'toolbar.php' ?>
        <?php require 'navbar.php' ?>

        <div class="window-bg">
            <div class="container">
                <div class="row window col-lg-10 col-lg-offset-1">
                    <form class="form col-lg-offset-3 col-lg-6" id="createGenreForm" action="createGenre.php"  method="POST"><!--submits data to be processed in CreateGenre(php validation) and validateCreateGenre(js validation-->
                        <table border="0">
                            <tbody>
                                <tr><h1 class="col-lg-10">Create Genre Form</h1></tr>
                            <tr>
                                <td><h3 class="col-lg-6">Genre Name</h3></td>
                                <td class="col-lg-6">
                                    <input class="input"type="text" name="genreName" value="" /><br>
                                    <span id="genreNameError" class="error"><!--inside span elements the error messages will be displayed-->
                                        <?php
                                        if (isset($errorMessage) && isset($errorMessage['genreName'])) {
                                            echo $errorMessage['genreName'];
                                        }
                                        ?></span>
                                </td>
                            </tr>
                            <tr>
                                <td><h3 class="col-lg-6">Description</h3></td>
                                <td class="col-lg-6">
                                    <input class="input" type="text" name="description" value="" /><br>
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
                </div>
            </div>
        </div>
    </div>
    <?php require 'footer.php' ?>    
    <?php require 'scripts.php'; ?>
</body>
</html>