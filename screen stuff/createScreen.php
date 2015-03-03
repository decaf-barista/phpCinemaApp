<?php
require_once 'Connection.php';
require_once 'ScreenTableGateway.php';

$connection = Connection::getInstance();

$gateway = new ScreenTableGateway($connection);

$id = session_id();
if ($id == "") {
    session_start();
}


$seatNumber = filter_input(INPUT_POST, 'seatNumber', FILTER_SANITIZE_STRING);
$fireExits = filter_input(INPUT_POST, 'fireExits', FILTER_SANITIZE_STRING);

$errorMessage = array();
if ($seatNumber === FALSE || $seatNumber === '') {
    $errorMessage['seatNumber'] = 'Seat Number must not be blank<br/>';
}

if ($fireExits === FALSE || $fireExits === '') {
    $errorMessage['fireExits'] = 'Fire Exits must not be blank<br/>';
}

if (empty($errorMessage)) {
    $gateway->insertScreen($seatNumber, $fireExits);

    header('Location: home.php');
}
else {
    require 'createScreenForm.php';
}


