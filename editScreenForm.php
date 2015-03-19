 <?php
require_once 'Connection.php';
require_once 'ScreenTableGateway.php';

$id = session_id();
if ($id == "") {
    session_start();
}

require 'ensureUserLoggedIn.php';

if (!isset($_GET) || !isset($_GET['screenID'])) {
    die('Invalid request');
}
$screenID = $_GET['screenID'];

$connection = Connection::getInstance();
$gateway = new ScreenTableGateway($connection);

$statement = $gateway->getScreenById($screenID);
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
        <script type="text/javascript" src="js/screen.js"></script>
    </head>
    </head>
    <body>
        <?php require 'toolbar.php' ?>
        
        <?php require 'navbar.php' ?>
        <?php
            if (isset($errorMessage)) {
                echo '<p>Error: ' . $errorMessage . '</p>';
            }
        ?>  
       <form action="editScreen.php" method="POST" id="editScreenForm"><!--submits data to be processed in CreateScreen(php validation) and validateCreateScreen(js validation-->
           <input type="hidden" name="screenID" value="<?php echo $screenID; ?>" />
           <table border="0">
                <tbody>
                    <tr>
                        <td>Number of Seats</td>
                        <td>
                            <input type="text" name="seatNumber" value="<?php
                                if (isset($_POST) && isset($_POST['seatNumber'])) {
                                    echo $_POST['seatNumber'];
                                }
                                else echo $row['seatNumber'];
                            ?>" />
                            <span id="seatNumberError" class="error"><!--inside span elements the error messages will be displayed-->
                                <?php
                                if (isset($errorMessage) && isset($errorMessage['seatNumber'])) {
                                    echo $errorMessage['seatNumber'];
                                }
                                ?></span>
                        </td>
                    </tr>
                    <tr>
                        <td>Number of Fire Exits</td>
                        <td>
                            <input type="text" name="fireExits" value="<?php
                                if (isset($_POST) && isset($_POST['fireExits'])) {
                                    echo $_POST['fireExits'];
                                }
                                else echo $row['fireExits'];
                            ?>" />
                            <span id="fireExitsError" class="error"><!--inside span elements the error messages will be displayed-->
                                <?php
                                if (isset($errorMessage) && isset($errorMessage['fireExits'])) {
                                    echo $errorMessage['fireExits'];
                                }
                                ?>
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="submit" value="Update Screen" name="updateScreen" />
                        </td>
                    </tr>
                </tbody>
            </table>

        </form>
        <?php require 'footer.php' ?>
    </body>
</html>
