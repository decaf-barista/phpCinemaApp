<?php
require_once 'Connection.php';
require_once 'ScreenTableGateway.php';
require 'ensureUserLoggedIn.php';

$id = session_id();
if ($id == "") {
    session_start();
}

$connection = Connection::getInstance();
$gateway = new ScreenTableGateway($connection);

$statement = $gateway->getScreens();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link rel="stylesheet" type="text/css" href="style.css">
        <script type="text/javascript" src="js/screen.js"></script>
    </head>
    <body>
        <?php require 'toolbar.php' ?>
        <?php require 'header.php' ?>
        <?php require 'navbar.php' ?>`
        <?php 
        if (isset($message)) {
            echo '<p>'.$message.'</p>';
        }
        ?>
        <table> <!--info table-->
            <thead>
                <tr>
                    <th>Screen ID</th>
                    <th>Number of Seats</th>
                    <th>Number of Fire Exits</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $row = $statement->fetch(PDO::FETCH_ASSOC);
                while ($row) {
                    echo '<tr>';//gets the info from createScreenForm and inputs it to the table// 
                    echo '<td>' . $row['screenID'] . '</td>';
                    echo '<td>' . $row['seatNumber'] . '</td>';
                    echo '<td>' . $row['fireExits'] . '</td>';
                    echo '<td>'
                    .'<a href="viewScreen.php?screenID=' .$row['screenID']. '">View</a> '
                    .'<a class="deleteScreen" href="deleteScreen.php?screenID=' .$row['screenID']. '">Delete</a> '
                    .'<a href="editScreenForm.php?screenID=' .$row['screenID']. '">Edit</a> '
                    . '</td>';
                    echo '</tr>';
                    
                    $row = $statement->fetch(PDO::FETCH_ASSOC);
                }
                ?>
            </tbody>
        </table>
        <p><a href="createScreenForm.php">Create Screen</a></p>
        <?php require 'footer.php' ?>
    </body>
</html>
