<?php
require_once 'Connection.php';
require_once 'GenreTableGateway.php';

$id = session_id();
if ($id == "") {
    session_start();
}

require 'ensureUserLoggedIn.php';

if (!isset($_GET) || !isset($_GET['genreID'])) {
    die('Invalid request');
}
$genreID = $_GET['genreID'];

$connection = Connection::getInstance();
$gateway = new GenreTableGateway($connection);

$statement = $gateway->getGenreByID($genreID);
if ($statement->rowCount() !== 1) {
    die("Illegal request");
}
$row = $statement->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<!--
Amy Meagher N00130270
-->
<html>
    <head>
        <?php require 'styles.php' ?>
        <script type="text/javascript" src="js/genre.js"></script>
    </head>
    <body>
        <?php require 'toolbar.php' ?>

        <?php require 'navbar.php' ?>
        <?php
        if (isset($errorMessage)) {
            echo '<p>Error: ' . $errorMessage . '</p>';
        }
        ?>  
        <div class="window-bg">
            <div class="container">
                <div class="row window col-lg-10 col-lg-offset-1">
                    <form class="form col-lg-offset-3 col-lg-6" action="editGenre.php" method="POST" id="editGenreForm"><!--submits data to be processed in CreateGenre(php validation) and validateCreateGenre(js validation-->
                        <input type="hidden" name="genreID" value="<?php echo $genreID; ?>" />
                        <table border="0">
                            <tbody>
                                <tr><h1 class="col-lg-10">Edit Genre Form</h1></tr>
                                <tr>
                                    <td class="col-lg-6"><h3>Genre Name</h3></td>
                                    <td class="col-lg-6">
                                        <input class="input" type="text" name="genreName" value="<?php
                                        if (isset($_POST) && isset($_POST['genreName'])) {
                                            echo $_POST['genreName'];
                                        } else
                                            echo $row['genreName'];
                                        ?>" /><br>
                                        <span id="genreNameError" class="error"><!--inside span elements the error messages will be displayed-->
                                            <?php
                                            if (isset($errorMessage) && isset($errorMessage['genreName'])) {
                                                echo $errorMessage['genreName'];
                                            }
                                            ?></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="col-lg-6"><h3>Description</h3></td>
                                    <td class="col-lg-6">
                                        <input class="input" type="text" name="description" value="<?php
                                        if (isset($_POST) && isset($_POST['description'])) {
                                            echo $_POST['description'];
                                        } else
                                            echo $row['description'];
                                        ?>" /><br>
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
                                        <input class="edit-submit" type="submit" value="Update Genre" name="updateGenre" />
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php require 'footer.php'; ?>
    <?php require 'scripts.php'; ?>
</body>
</html>
