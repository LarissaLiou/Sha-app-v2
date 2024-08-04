<?php
session_start();
include_once 'connect.inc.php';

$emailUsername = $_POST['emailUsername'];
$password =  $_POST['password'];

$_SESSION['login_attempt'] = true; //resets login attempt failure
$_SESSION['error'] = '';

$sql = 'SELECT COUNT(*) FROM users WHERE email = ? OR username = ? AND password = ?';
$stmt = prepared_query($conn, $sql, [$emailUsername, $emailUsername, $password], 'sss');
$stmt->execute();
$stmt->bind_result($exist);
$stmt->fetch();
$stmt->close();

if ($exist){
    $_SESSION['loggedin'] = true;
    $_SESSION['login_attempt'] = true;
    header("Location: ../index.php?filename=home");
} else{
    $_SESSION['loggedin'] = false;
    $_SESSION['login_attempt'] = false; //used to alert users of incorrect username or password after redirect
    $_SESSION['error'] = 'Username or Password is incorrect';
    header("Location: ../index.php?filename=login");
}

?>