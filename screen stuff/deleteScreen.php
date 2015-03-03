<?php
require_once 'Connection.php';
require_once 'ScreenTableGateway.php';
require 'ensureUserLoggedIn.php';

$id = session_id();
if ($id == "") {
    session_start();
}

$connection = Connection::getInstance();
$gateway = new ScreenTableGateway($connection);

if (!isset($_GET) || !isset($_GET['screenID'])) {
    die('Invalid request');
}
$screenID = $_GET['screenID'];

$gateway->deleteScreen($screenID);

header("Location: home.php")
?>