<?php
require_once 'connection.php';
require_once 'ReviewTableGateway.php';
require_once 'MovieTableGateway.php';
require 'ensureUserLoggedIn.php';

$id = session_id();
if ($id == "") {
    session_start();
}

if (!isset($_GET) || !isset($_GET['reviewID'])) {
    die('Invalid request');
}
$reviewID = $_GET['reviewID'];

$conn = Connection::getInstance();
$movieGateway = new MovieTableGateway($conn);
$reviewGateway = new ReviewTableGateway($conn);

$reviews = $reviewGateway->getReviewById($reviewID);
if ($reviews->rowCount() !== 1) {
    die("Illegal request");
}
$review = $reviews->fetch(PDO::FETCH_ASSOC);

$sortOrder = 'movieID';
$movies = $movieGateway->getMovies($sortOrder);
?>
<!DOCTYPE html>
<html>
    <head>
        <?php require 'styles.php' ?>
        <script type="text/javascript" src="js/review.js"></script>  
    </head>
    <body>
        <?php require 'toolbar.php' ?>
        <?php require 'navbar.php' ?>

        <div class="window-bg">
            <div class="container">
                <div class="row window col-lg-10 col-lg-offset-1">
                    <form class="form col-lg-offset-3 col-lg-6" id="editReviewForm" action="editReview.php"  method="POST"><!--submits data to be processed in CreateMovie(php validation)-->
                        <input type="hidden" name="reviewID" value="<?php echo $reviewID; ?>" />
                        <table border="0">
                            <tbody>
                                <tr><h1 class="col-lg-10">Edit Review Form</h1></tr>
                            <tr>
                                <td class="col-lg-6"><h3>Movie</h3></td>
                                <td class="col-lg-6">
                                    <select name="movieID">
                                        <?php
                                        $m = $movies->fetch(PDO::FETCH_ASSOC);
                                        while ($m) {
                                            $selected = "";
                                            if ($m['movieID'] == $review['title']) {
                                                $selected = "selected";
                                            }
                                            echo '<option value="' . $m['movieID'] . '"' . $selected . '>' . $m['title'] . '</option>';
                                            $m = $movies->fetch(PDO::FETCH_ASSOC);
                                        }
                                        ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td><h3 class="col-lg-6">Rating</h3></td><!--column name-->
                                <td class="col-lg-6">
                                    <select name="rating">
                                        <?php
                                            $selected = "";
                                            if ($review['rating']) {
                                                $selected = "selected";
                                            }
                                            if($review['rating']== 1){
                                                echo '<option value="' . $review['rating'] . '" ' . $selected . '>' . $review['rating'] . ' Star</option>';
                                            }
                                            else{
                                                echo '<option value="' . $review['rating'] . '" ' . $selected . '>' . $review['rating'] . ' Stars</option>';
                                            }
                                        ?>
                                        <option value="1">1 Star</option>
                                        <option value="2">2 Stars</option>
                                        <option value="3">3 Stars</option>
                                        <option value="4">4 Stars</option>
                                        <option value="5">5 Stars</option>
                                    </select>
                                </td>
                                </td>
                            </tr>
                            <tr>
                                <td><h3 class="col-lg-6">Review</h3></td><!--column name-->
                                <td class="col-lg-6">
                                    <textarea cols="40" rows="4" class="input" type="text" name="reviewContent" /><?php
                                    if (isset($_POST) && isset($_POST['reviewContent'])) {
                                        echo $_POST['reviewContent'];
                                    } else
                                        echo $review['reviewContent'];
                                    ?></textarea><br>
                                    <span id="reviewContentError" class="error"><!--inside span elements the error messages will be displayed-->
                                        <?php
                                        if (isset($errorMessage) && isset($errorMessage['reviewContent'])) {
                                            echo $errorMessage['reviewContent'];
                                        }
                                        ?>
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <input class="edit-submit" type="submit" value="Update Movie" name="updateMovie" />
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
    <?php require 'scripts.php'; ?>
</body>
</html>
