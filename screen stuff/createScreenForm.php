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
        <link rel="stylesheet" type="text/css" href="style.css"><!--css-->
        <script type="text/javascript" src="js/screen.js"></script><!--javascript validation-->
    </head>
    <body>
        <?php require 'toolbar.php' ?>
        <?php require 'header.php' ?>
        <?php require 'navbar.php' ?>`
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
