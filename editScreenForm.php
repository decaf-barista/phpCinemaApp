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
        <?php require 'styles.php' ?>
        <script type="text/javascript" src="js/screen.js"></script>
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
                <form class="form col-lg-offset-2 col-lg-8" action="editScreen.php" method="POST" id="editScreenForm"><!--submits data to be processed in CreateScreen(php validation) and validateCreateScreen(js validation-->
                    <input type="hidden" name="screenID" value="<?php echo $screenID; ?>" />
                    <table border="0">
                        <tbody>
                            <tr><h1 class="col-lg-10">Edit Screen Form</h1></tr>
                            <tr>
                                <td class="col-lg-6"><h3>Number of Seats</h3></td>
                                <td class="col-lg-6">
                                    <input class="input" type="text" name="seatNumber" value="<?php
                                    if (isset($_POST) && isset($_POST['seatNumber'])) {
                                        echo $_POST['seatNumber'];
                                    } else
                                        echo $row['seatNumber'];
                                    ?>" /><br>
                                    <span id="seatNumberError" class="error"><!--inside span elements the error messages will be displayed-->
                                        <?php
                                        if (isset($errorMessage) && isset($errorMessage['seatNumber'])) {
                                            echo $errorMessage['seatNumber'];
                                        }
                                        ?></span>
                                </td>
                            </tr>
                            <tr>
                                <td class="col-lg-6"><h3>Number of Fire Exits</h3></td>
                                <td class="col-lg-6">
                                    <input class="input" type="text" name="fireExits" value="<?php
                                    if (isset($_POST) && isset($_POST['fireExits'])) {
                                        echo $_POST['fireExits'];
                                    } else
                                        echo $row['fireExits'];
                                    ?>" /><br>
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
                                    <input class="edit-submit" type="submit" value="Update Screen" name="updateScreen" />
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </form>
            </div>
        </div>
    </div>
    <?php require 'footer.php' ?>
    <?php require 'scripts.php'; ?>
</body>
</html>
