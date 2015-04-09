<?php
require_once 'connection.php';
require_once 'MovieTableGateway.php';
$id = session_id();
if ($id == "") {
    session_start();
}

require 'ensureUserLoggedIn.php';
$conn = Connection::getInstance();
$movieGateway = new MovieTableGateway($conn);

$sortOrder = 'movieID';
$movies = $movieGateway->getMovies($sortOrder);
?>
<!DOCTYPE html>
<html>
    <head>
        <?php require 'styles.php' ?><!--reference this in my head rather than have to copy every little thing-->
        <script type="text/javascript" src="js/review.js"></script>  
    </head>
    <body>
        <?php require 'toolbar.php' ?>
        <?php require 'navbar.php' ?>

        <div class="window-bg">
            <div class="container">
                <div class="row window col-lg-10 col-lg-offset-1">
                    <form class="form col-lg-offset-2 col-lg-8" id="createReviewForm" action="createReview.php"  method="POST"><!--submits data to be processed in CreateMovie(php validation)-->
                        <table border="0">
                            <tbody>
                                <tr><h1>Create Review Form</h1></tr><!--table title-->       
                            <tr>
                                <td><h3 class="col-lg-6">Movie</h3></td><!--column name-->
                                <td class="col-lg-6">
                                    <select name="movieID"><!--drop down menu which display the title of all the movies in my system-->
                                        <?php
                                        $m = $movies->fetch(PDO::FETCH_ASSOC);
                                        while ($m) {
                                            echo '<option value="' . $m['movieID'] . '">' . $m['title'] . '</option>';
                                            $m = $movies->fetch(PDO::FETCH_ASSOC);
                                        }
                                        ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td><h3 class="col-lg-6">Rating</h3></td><!--column name-->
                                <td class="col-lg-6">
                                    <select name="rating"><!--simple drop down menu on the view pages will display image rather than text, don't want user to put in a value outside the bounds of my 5 star system-->
                                        <option value="1">1 Star</option>
                                        <option value="2">2 Stars</option>
                                        <option value="3">3 Stars</option>
                                        <option value="4">4 Stars</option>
                                        <option value="5">5 Stars</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td><h3 class="col-lg-6">Review</h3></td><!--column name-->
                                <td class="col-lg-6">
                                    <textarea cols="40" rows="4" class="input" type="text" name="reviewContent" value="" /></textarea><br>
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
                                <td>
                                    <input class="submit" type="submit" value="Create Review" name="createReview" />
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
    <?php require 'scripts.php'; ?><!--bootstrap scripts stuff-->
</body>
</html>
