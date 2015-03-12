<?php
require_once 'Connection.php';
require_once 'MovieTableGateway.php';
require 'ensureUserLoggedIn.php';

$id = session_id();
if ($id == "") {
    session_start();
}

$connection = Connection::getInstance();
$gateway = new MovieTableGateway($connection);

if (!isset($_GET) || !isset($_GET['movieID'])) {
    die('Invalid request');
}
$movieID = $_GET['movieID'];

$gateway->deleteMovie($movieID);

header("Location: home.php")
?>