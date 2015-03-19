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
        <h1>Create Screen Form</h1>
        
        <form id="createScreenForm" action="createScreen.php"  method="POST"><!--submits data to be processed in CreateScreen(php validation) and validateCreateScreen(js validation-->
            <table border="0">
                <tbody>
                    <tr>
                        <td>Number of Seats</td>
                        <td>
                            <input type="text" name="seatNumber" value="" />
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
                            <input type="text" name="fireExits" value="" />
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
                            <input type="submit" value="Create Screen" name="createScreen" />
                        </td>
                    </tr>
                </tbody>
            </table>

        </form>
        <?php require 'footer.php' ?>        
    </body>
</html>