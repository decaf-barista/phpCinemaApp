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
        <meta charset="UTF-8">
        <title></title>
        <link rel="stylesheet" type="text/css" href="style.css"><!--css-->
        <script type="text/javascript" src="js/screen.js"></script>
    </head>
    <body>
        <?php require 'toolbar.php' ?>
        
        <?php require 'navbar.php' ?>
        <?php
        if (isset($message)) {
        echo '<p>'.$message.'</p>';
        }
        ?>
        <table>
            <tbody>
                <?php
                    $row = $statement->fetch(PDO::FETCH_ASSOC);
                    echo '<tr>';
                    echo '<td>Screen ID</td>' 
                    . '<td>' . $row['screenID'] . '</td>';
                    echo '</tr>';
                    echo '<tr>';
                    echo '<td>Seat Numbers</td>' 
                    . '<td>' . $row['seatNumber'] . '</td>';
                    echo '</tr>';
                    echo '<tr>';
                    echo '<td>Fire Exits</td>' 
                    . '<td>' . $row['fireExits'] . '</td>';
                    echo '</tr>';
                ?>
            </tbody>
        </table>
        <p><a href="editScreenForm.php?screenID=<?php echo $row['screenID']; ?>">
                Edit Screen</a>
            <a class="deleteScreen" href="deleteScreen.php?screenID=<?php echo $row['screenID']; ?>">
                Delete Screen</a>
        </p>
        <?php require 'footer.php' ?>
    </body>
</html>
