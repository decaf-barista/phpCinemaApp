<?php
//N00132070
require_once 'Connection.php';
require_once 'ReviewTableGateway.php';

$id = session_id();
if ($id == "") {
    session_start();
}

require 'ensureUserLoggedIn.php';

if (!isset($_GET) || !isset($_GET['reviewID'])) {
    die('Invalid request');
}
$reviewID = $_GET['reviewID'];

$connection = Connection::getInstance();
$gateway = new ReviewTableGateway($connection);

$statement = $gateway->getReviewById($reviewID);
?>
<!DOCTYPE html>
<html>
    <head>
    <head>
        <?php require 'styles.php' ?>
        <script type="text/javascript" src="js/review.js"></script>
    </head>
</head>
<body>
    <?php require 'toolbar.php' ?>
    <?php require 'navbar.php' ?>
    <?php
    if (isset($message)) {
        echo '<p>' . $message . '</p>';
    }
    $row = $statement->fetch(PDO::FETCH_ASSOC);
    ?>
    <div class="container">
        <p class="col-lg-3 col-lg-offset-7">
            <a href="editReviewForm.php?reviewID=<?php echo $row['reviewID']; ?>"><img src="Images/edit.png" class="crud"></a>
            <a class="deleteReview" href="deleteReview.php?reviewID=<?php echo $row['reviewID']; ?>"><img src="Images/delete.png" class="crud"></a>
        </p>
        <table class="view col-lg-4 col-lg-offset-4">
            <tbody>
                <?php
                echo '<tr>';
                echo '<td><p>Review ID</p><br>'
                . '<span>' . $row['reviewID'] . '</span></td>';
                echo '</tr>';
                echo '<tr>';
                echo '<td><p>Movie</p><br>'
                . '<span>' . $row['title'] . '</span></td>';
                echo '</tr>';
                echo '<tr>';
                echo '<td><p>Rating</p><br>'
                . '<span><img src="Images/' . $row['rating'] . '.png" class="classification"></span></td>';
                echo '</tr>';
                echo '<tr>';
                echo '<td><p>Review</p><br>'
                . '<span>' . $row['reviewContent'] . '</span></td>';
                echo '</tr>';
                ?>
            </tbody>
        </table>
    </div>
    <?php require 'footer.php' ?>
    <?php require 'scripts.php' ?>
</body>
</html>
