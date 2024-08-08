<?php
session_start();
require_once __dir__."/../Defaults/connect.inc.php";
require_once __dir__."/../Defaults/validate.inc.php";
require_once __dir__."/login_api.inc.php";


if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: ../index.php?filename=signup");
    exit();
}
// strip tags and escape string
$email = $_POST['email'];
$email = filter_var($email, FILTER_SANITIZE_EMAIL);
$email = trim($email);
$username = $_POST['username'];
$username = trim($username);
$password1 = $_POST['password1'];
$password2 = $_POST['password2'];

//checks if password and confirm password is the same
if ($password1 === $password2){
    $password = $password1;
} else{
    $_SESSION['login_attempt'] = false;
    
    header("Location: ../index.php?filename=signup&error=Passwords do not match");
    exit();
}


$existEmail = false;
$sql = 'SELECT COUNT(*) as count FROM users WHERE email = ?';
$data = executeSelect($mysqli, $sql, 's', [$email]);
$existEmail = $data['data'][0]['count'];
$existUsername = false;
$sql = 'SELECT COUNT(*) as count FROM users WHERE username = ?';
$data = executeSelect($mysqli, $sql, 's', [$username]);
$existUsername = $data['data'][0]['count'];

if ($existEmail){
    $_SESSION['login_attempt'] = false;
    header("Location: ../../index.php?filename=signup&error=Email already exists");
    exit();
}
if ($existUsername){
    $_SESSION['login_attempt'] = false;
    header("Location: ../../index.php?filename=signup&error=Username already exists");
    exit();
} 

//hashing the password
$user_id = onSignUp($mysqli, $username, $username, $email, '', $password);
onLogin($mysqli, $user_id);
header("Location: ../../index.php?filename=interest");
