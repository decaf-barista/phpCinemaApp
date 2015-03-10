<?php
require_once 'Connection.php';
require_once 'MovieTableGateway.php';

$connection = Connection::getInstance();

$gateway = new MovieTableGateway($connection);

$id = session_id();
if ($id == "") {
    session_start();
}


$title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING);
$movieYear = filter_input(INPUT_POST, 'movieYear', FILTER_SANITIZE_STRING);
$runTime = filter_input(INPUT_POST, 'runTime', FILTER_SANITIZE_STRING);
$classification = filter_input(INPUT_POST, 'classification', FILTER_SANITIZE_STRING);
$directorFName = filter_input(INPUT_POST, 'directorFName', FILTER_SANITIZE_STRING);
$directorLName = filter_input(INPUT_POST, 'directorLName', FILTER_SANITIZE_STRING);
$genre = filter_input(INPUT_POST, 'genre', FILTER_SANITIZE_STRING);

$errorMessage = array();
if ($title === FALSE || $title === '') {
    $errorMessage['title'] = 'Title must not be blank<br/>';
}

if ($movieYear === FALSE || $movieYear === '') {
    $errorMessage['movieYear'] = 'Movie year must not be blank<br/>';
}

if ($runTime === FALSE || $runTime === '') {
    $errorMessage['runTime'] = 'Run time must not be blank<br/>';
}

if ($classification === FALSE || $classification === '') {
    $errorMessage['classification'] = 'Classification must not be blank<br/>';
}

if ($directorFName === FALSE || $directorFName === '') {
    $errorMessage['directorFName'] = 'Director first name year must not be blank<br/>';
}

if ($directorLName === FALSE || $directorLName === '') {
    $errorMessage['directorLName'] = 'Director last name must not be blank<br/>';
}

if ($genre === FALSE || $genre === '') {
    $errorMessage['genre'] = 'Genre must not be blank<br/>';
}

if (empty($errorMessage)) {
    $gateway->insertMovie( $title, $movieYear, $runTime, $classification, $directorFName, $directorLName, $genre);

    header('Location: home.php');
}
else {
    require 'createMovieForm.php';
}


