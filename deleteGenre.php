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

if (!isset($_GET) || !isset($_GET['genreName'])) {
    die('Invalid request');
}
$genreName = $_GET['genreName'];

$gateway->deleteGenre($genreName);

header("Location: viewGenres.php")
?>