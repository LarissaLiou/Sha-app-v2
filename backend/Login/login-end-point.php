<?php
session_start();
require_once __dir__."/../Defaults/connect.inc.php";
require_once __dir__."/../Defaults/validate.inc.php";
require_once __dir__."/login_api.inc.php";
$emailUsername = $_POST['emailUsername'];
$password =  $_POST['password'];
$password = filter_var($password, FILTER_SANITIZE_STRING);
$emailUsername = filter_var($emailUsername, FILTER_SANITIZE_STRING);
$emailUsername = trim($emailUsername);

//preparing hashed password
$userId = verifyLoginCredentials($mysqli, $emailUsername, $password);

if ($userId){
    onLogin($mysqli, $userId);
    header("Location: ../../index.php?filename=home");
} else{
    $_SESSION['loggedin'] = false;
    header("Location: ../../index.php?filename=login&error=Incorrect username or password");
}

