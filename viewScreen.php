<?php
//N00132070
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
?>
<!DOCTYPE html>
<html>
    <head>
        <?php require 'styles.php' ?>
        <script type="text/javascript" src="js/screen.js"></script>
    </head>
<body>
    <?php require 'toolbar.php' ?>

    <?php require 'navbar.php' ?>
    <?php
    if (isset($message)) {
        echo '<p>' . $message . '</p>';
    }
    $row = $statement->fetch(PDO::FETCH_ASSOC);
    ?><div class="container">
        <p class="col-lg-3 col-lg-offset-7">
            <a href="editScreenForm.php?screenID=<?php echo $row['screenID']; ?>"><img src="Images/edit.png" class="crud"></a>
            <a class="deleteScreen" href="deleteScreen.php?screenID=<?php echo $row['screenID']; ?>"><img src="Images/delete.png" class="crud"></a>
        </p>
        <table class="view col-lg-4 col-lg-offset-4">
            <tbody>
                <?php
                
                echo '<tr>';
                echo '<td><p>Screen ID</p><br>'
                . '<span>' . $row['screenID'] . '</span></td>';
                echo '</tr>';
                echo '<tr>';
                echo '<td><p>Seat Numbers</p><br>'
                . '<span>' . $row['seatNumber'] . '</span></td>';
                echo '</tr>';
                echo '<tr>';
                echo '<td><p>Fire Exits</p><br>'
                . '<span>' . $row['fireExits'] . '</span></td>';
                echo '</tr>';
                ?>
            </tbody>
        </table>
    </div>
    <?php require 'footer.php' ?>
    <?php require 'scripts.php' ?>
</body>
</html>
