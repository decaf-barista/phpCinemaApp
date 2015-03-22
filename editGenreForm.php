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
        <?php
            if (isset($errorMessage)) {
                echo '<p>Error: ' . $errorMessage . '</p>';
            }
        ?>  
       <form action="editGenre.php" method="POST" id="editGenreForm"><!--submits data to be processed in CreateGenre(php validation) and validateCreateGenre(js validation-->
           <input type="hidden" name="genreID" value="<?php echo $genreID; ?>" />
           <table border="0">
                <tbody>
                    <tr>
                        <td>Genre Name</td>
                        <td>
                            <input type="text" name="genreName" value="<?php
                                if (isset($_POST) && isset($_POST['genreName'])) {
                                    echo $_POST['genreName'];
                                }
                                else echo $row['genreName'];
                            ?>" />
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
                            <input type="text" name="description" value="<?php
                                if (isset($_POST) && isset($_POST['description'])) {
                                    echo $_POST['description'];
                                }
                                else echo $row['description'];
                            ?>" />
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
                            <input type="submit" value="Update Genre" name="updateGenre" />
                        </td>
                    </tr>
                </tbody>
            </table>

        </form>
        <?php require 'footer.php' ?>
    </body>
</html>
