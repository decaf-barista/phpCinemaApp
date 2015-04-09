<?php
require_once 'Connection.php';
require_once 'ReviewTableGateway.php';
require 'ensureUserLoggedIn.php';

$id = session_id();
if ($id == "") {
    session_start();
}

$connection = Connection::getInstance();
$gateway = new ReviewTableGateway($connection);

if (!isset($_GET) || !isset($_GET['reviewID'])) {
    die('Invalid request');
}
$reviewID = $_GET['reviewID'];

$gateway->deleteReview($reviewID);

header("Location: viewReviews.php")
?>