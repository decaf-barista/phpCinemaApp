<?php
require_once 'Connection.php';
require_once 'MovieTableGateway.php';

$id = session_id();
if ($id == "") {
    session_start();
}

$connection = Connection::getInstance();
$gateway = new MovieTableGateway($connection);

require 'ensureUserLoggedIn.php';

$movieID= filter_input(INPUT_POST, 'movieID',FILTER_SANITIZE_NUMBER_INT);
$title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING);
$movieYear = filter_input(INPUT_POST, 'movieYear', FILTER_SANITIZE_NUMBER_INT);
$runTime = filter_input(INPUT_POST, 'runTime', FILTER_SANITIZE_NUMBER_INT);
$classification = filter_input(INPUT_POST, 'classification', FILTER_SANITIZE_STRING);
$directorFName = filter_input(INPUT_POST, 'directorFName', FILTER_SANITIZE_STRING);
$directorLName = filter_input(INPUT_POST, 'directorLName', FILTER_SANITIZE_STRING);
$genre = filter_input(INPUT_POST, 'genre', FILTER_SANITIZE_STRING);

if ($genre == -1) {
    $genre = NULL;
}

$gateway->updateMovie($movieID, $title, $movieYear, $runTime, $classification, $directorFName, $directorLName, $genre);

header('Location: viewMovies.php');


