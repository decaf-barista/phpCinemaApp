<?php
require_once 'Connection.php';
require_once 'ReviewTableGateway.php';
require_once 'ReviewTableGateway.php';
require 'ensureUserLoggedIn.php';

$id = session_id();
if ($id == "") {
    session_start();
}

if (isset($_GET) && isset($_GET['sortOrder'])){
    $sortOrder =$_GET['sortOrder'];
    $columnNames = array("reviewID", "reviewID", "rating", "reviewContent");
    if(!in_array($sortOrder, $columnNames)){
        $sortOrder = 'reviewID';
    }
}
else{
    $sortOrder = 'reviewID';
}

$connection = Connection::getInstance();
$gateway = new ReviewTableGateway($connection);

$statement = $gateway->getReviews($sortOrder);
?>
<!DOCTYPE html>
<html>
    <head>
        <?php require 'styles.php' ?>
        <script type="text/javascript" src="js/review.js"></script>
    </head>
    <body>
        <?php require 'toolbar.php' ?>
        <?php require 'navbar.php' ?>`
        <?php 
        if (isset($message)) {
            echo '<p>'.$message.'</p>';
        }
        ?>
        <div class="container">
            <a href="createReviewForm.php"><img src="Images/add.png" class="crud col-lg-offset-11 col-lg-1"></a>
            <table class="zui-table zui-table-horizontal zui-table-highlight col-lg-10 col-lg-offset-1"> <!--info table-->
                <thead>
                <tr>
                    <th><a href="viewReviews.php?sortOrder=reviewID">Review ID</a></th>
                    <th><a href="viewReviews.php?sortOrder=movieID">Movie</a></th>
                    <th><a href="viewReviews.php?sortOrder=rating">Rating</a></th>
                    <th><a href="viewReviews.php?sortOrder=reviewContent">Review</a></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                $row = $statement->fetch(PDO::FETCH_ASSOC);
                while ($row) {
                    echo '<tr>';//gets the info from createReviewForm and inputs it to the table// 
                    echo '<td>' . $row['reviewID'] . '</td>';
                    echo '<td>' . $row['movieID'] . '</td>';
                    echo '<td>' . $row['rating'] . '</td>';
                    echo '<td>' . $row['reviewContent'] . '</td>';
                    echo '<td>'
                    . '<a href="viewReview.php?reviewID=' . $row['reviewID'] . '"><img src="Images/view.png" class="crud"></a> '
                    . '<a class="deleteReview" href="deleteReview.php?reviewID=' . $row['reviewID'] . '"><img src="Images/delete.png" class="crud"></a> '
                    . '<a href="editReviewForm.php?reviewID=' . $row['reviewID'] . '"><img src="Images/edit.png" class="crud"></a> '
                    . '</td>';
                    echo '</tr>';
                    
                    $row = $statement->fetch(PDO::FETCH_ASSOC);
                }
                ?>
              </tbody>
            </table>        
        </div>
        <?php require 'footer.php' ?>
        <?php require 'scripts.php' ?>
    </body>
</html>
