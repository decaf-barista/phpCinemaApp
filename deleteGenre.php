<?php
require_once 'Connection.php';
require_once 'GenreTableGateway.php';
require 'ensureUserLoggedIn.php';

$id = session_id();
if ($id == "") {
    session_start();
}

$connection = Connection::getInstance();
$gateway = new GenreTableGateway($connection);

if (!isset($_GET) || !isset($_GET['genreID'])) {
    die('Invalid request');
}
$genreID = $_GET['genreID'];

$gateway->deleteGenre($genreID);

header("Location: viewGenres.php")
?>