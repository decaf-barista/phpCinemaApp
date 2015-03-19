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
        <head>
        <meta charset = "utf-8"><!--lets my browser read and display characters-->
        <meta name="viewport" content="width=device-width initial-scale=1.0"><!--will scale for the different with of pages-->
        <!--linking stylesheets-->
        <link href="css/bootstrap.min.css" rel="stylesheet"><!--using .min so it will be faster, framework style sheet-->
        <link href="css/custom.css" rel="stylesheet"><!--my own css file-->
        <link href='http://fonts.googleapis.com/css?family=Ubuntu+Condensed' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Ubuntu:700' rel='stylesheet' type='text/css'>
        <link rel="shortcut icon" href="Images/oscars.png"/>
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
