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
        <?php require 'styles.php' ?><!--everything inside my head tags-->
        <script type="text/javascript" src="js/screen.js"></script>
    </head>
    <body>
        <?php require 'toolbar.php' ?>
        <?php require 'navbar.php' ?>

        <div class="window-bg">
            <div class="container">
                <div class="row window col-lg-10 col-lg-offset-1">
                    <form class="form col-lg-offset-2 col-lg-8" id="createScreenForm" action="createScreen.php"  method="POST"><!--submits data to be processed in CreateScreen(php validation) and validateCreateScreen(js validation-->
                        <table border="0">
                            <tbody>
                                <tr><h1 class="col-lg-10">Create Screen Form</h1></tr><!--table title-->
                            <tr>
                                <td><h3 class="col-lg-6">Number of Seats</h3></td><!--column name-->
                                <td class="col-lg-6">
                                    <input class="input" type="text" name="seatNumber" value="" /><br>
                                    <span id="seatNumberError" class="error"><!--inside span elements the error messages will be displayed-->
                                        <?php
                                        if (isset($errorMessage) && isset($errorMessage['seatNumber'])) {
                                            echo $errorMessage['seatNumber'];
                                        }
                                        ?></span>
                                </td>
                            </tr>
                            <tr>
                                <td><h3 class="col-lg-6">Number of Fire Exits</h3></td><!--column name-->
                                <td class="col-lg-6">
                                    <input class="input" type="text" name="fireExits" value="" /><br>
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
                                <td></td>
                                <td>
                                    <input class="edit-submit" type="submit" value="Create Screen" name="createScreen" />
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
    <?php require 'scripts.php'; ?><!--bootstrap script-->
</body>
</html>