<?php
require_once 'Connection.php';
require_once 'GenreTableGateway.php';

$connection = Connection::getInstance();

$gateway = new GenreTableGateway($connection);

$id = session_id();
if ($id == "") {
    session_start();
}


$genreName = filter_input(INPUT_POST, 'genreName', FILTER_SANITIZE_STRING);
$description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);

$errorMessage = array();
if ($genreName === FALSE || $genreName === '') {
    $errorMessage['genreName'] = 'Genre name must not be blank<br/>';
}

if ($description === FALSE || $description === '') {
    $errorMessage['decription'] = 'Description must not be blank<br/>';
}

if (empty($errorMessage)) {
    $gateway->insertGenre($genreName, $description);

    header('Location: viewGenres.php');
}
else {
    require 'createGenreForm.php';
}


