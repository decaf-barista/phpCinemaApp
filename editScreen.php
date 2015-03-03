<?php
require_once 'Screen.php';
require_once 'Connection.php';
require_once 'ScreenTableGateway.php';

$id = session_id();
if ($id == "") {
    session_start();
}

require 'ensureUserLoggedIn.php';

$connection = Connection::getInstance();
$gateway = new ScreenTableGateway($connection);

$screenID = $_POST['screenID'];
$seatNumber = $_POST['seatNumber'];
$fireExits = $_POST['fireExits'];

$gateway->updateScreen($screenID, $seatNumber, $fireExits);

header('Location: home.php');

