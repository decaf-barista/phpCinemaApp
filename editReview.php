<?php
require_once 'Connection.php';
require_once 'ReviewTableGateway.php';

$connection = Connection::getInstance();

$gateway = new ReviewTableGateway($connection);

$id = session_id();
if ($id == "") {
    session_start();
}

$reviewID= filter_input(INPUT_POST, 'reviewID',FILTER_SANITIZE_NUMBER_INT);
$movieID = filter_input(INPUT_POST, 'movieID', FILTER_SANITIZE_STRING);
$rating = filter_input(INPUT_POST, 'rating', FILTER_SANITIZE_NUMBER_INT);
$reviewContent = filter_input(INPUT_POST, 'reviewContent', FILTER_SANITIZE_STRING);

$errorMessage = array();
if ($reviewContent === FALSE || $reviewContent === '') {
    $errorMessage['reviewContent'] = 'Review content must not be blank<br/>';
}

if (empty($errorMessage)) {
    $gateway->updateReview($reviewID, $movieID, $rating , $reviewContent);

    header('Location: viewReviews.php');
}
else {
    require 'editReviewForm.php';
}


