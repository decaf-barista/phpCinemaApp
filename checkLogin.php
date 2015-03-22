<?php
require_once 'Connection.php';
require_once 'AdminTableGateway.php';

$connection = Connection::getInstance();

$gateway = new AdminTableGateway($connection);

$id = session_id();
if ($id == "") {
    session_start();//start a php session//
}
//connects the attributes of admin object to the input fields in form//
$username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);


$errorMessage = array();//makes an array in which error messages can be displayed later//
if ($username === FALSE || $username === '') {
    $errorMessage['username'] = 'Username must not be blank<br/>';//if username is blank add string to array//
}

if ($password === FALSE || $password === '') {
    $errorMessage['password'] = 'Password must not be blank<br/>';//if password is blank add string to array//
}
if (empty($errorMessage)) {
    $statement = $gateway->getAdminByUsername($username);
    if ($statement->rowCount() != 1) {
        $errorMessage['username'] = 'Username not registered<br/>';
    }
    else if ($statement->rowCount() == 1) {
        $row = $statement->fetch(PDO::FETCH_ASSOC);
        if ($password !== $row['password']) {
            $errorMessage['password'] = 'Invalid password<br/>';
        }
    }
}
    
if (empty($errorMessage)) {
    $_SESSION['username'] = $username;
    header('Location: home.php');//redirects to home//
}
else {
    require 'login.php';//requests page again and diplays error messages// 
}
