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
        ?>
        <div class="container">
            <a href="createScreenForm.php"><img src="Images/add.png" class="crud col-lg-offset-11 col-lg-1"></a>
            <table class="zui-table zui-table-horizontal zui-table-highlight col-lg-8 col-lg-offset-2"> <!--info table-->
                <thead>
                    <tr>
                        <th>Screen ID</th>
                        <th>Number of Seats</th>
                        <th>Number of Fire Exits</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $row = $statement->fetch(PDO::FETCH_ASSOC);
                    while ($row) {
                        echo '<tr>'; //gets the info from createScreenForm and inputs it to the table// 
                        echo '<td>' . $row['screenID'] . '</td>';
                        echo '<td>' . $row['seatNumber'] . '</td>';
                        echo '<td>' . $row['fireExits'] . '</td>';
                        echo '<td>'
                        . '<a href="viewScreen.php?screenID=' . $row['screenID'] . '"><img src="Images/view.png" class="crud"></a> '
                        . '<a class="deleteScreen" href="deleteScreen.php?screenID=' . $row['screenID'] . '"><img src="Images/delete.png" class="crud"></a> '
                        . '<a href="editScreenForm.php?screenID=' . $row['screenID'] . '"><img src="Images/edit.png" class="crud"></a> '
                        . '</td>';
                        echo '</tr>';

                        $row = $statement->fetch(PDO::FETCH_ASSOC);
                    }
                    ?>
                </tbody>
            </table>        
        </div>
        <?php require 'footer.php' ?>
        <?php require 'scripts.php'; ?>
    </body>
</html>
