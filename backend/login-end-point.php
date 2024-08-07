<?php
session_start();
include_once 'connect.inc.php';

$emailUsername = $_POST['emailUsername'];
$password =  $_POST['password'];

$_SESSION['login_attempt'] = true; //resets login attempt failure
$_SESSION['error'] = '';

//preparing hashed password
$salt = 'apsojvpscpoxnkm';
$hash = hash('sha256', $password . $salt);
$sql = 'SELECT COUNT(*) FROM users WHERE email = ? OR username = ? AND password = ?';
$stmt = prepared_query($conn, $sql, [$emailUsername, $emailUsername, $hash], 'sss');
$stmt->execute();
$stmt->bind_result($exist);
$stmt->fetch();
$stmt->close();

if ($exist){
    $_SESSION['loggedin'] = true;
    $_SESSION['login_attempt'] = true;
    //set up session email to recognise user
    $_SESSION['emailUsername'] = $emailUsername;
    header("Location: ../index.php?filename=home");
} else{
    $_SESSION['loggedin'] = false;
    $_SESSION['login_attempt'] = false; //used to alert users of incorrect username or password after redirect
    $_SESSION['error'] = 'Username or Password is incorrect';
    header("Location: ../index.php?filename=login");
}

?>