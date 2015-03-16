<?php
require_once 'Connection.php';
require_once 'GenreTableGateway.php';

$id = session_id();
if ($id == "") {
    session_start();
}

require 'ensureUserLoggedIn.php';

$connection = Connection::getInstance();
$gateway = new GenreTableGateway($connection);

$genreID = $_POST['genreID'];
$genreName = $_POST['genreName'];
$description = $_POST['description'];

$gateway->updateGenre($genreID, $genreName, $description);

header('Location: viewGenres.php');

