<?php
session_start();
include_once 'connect.inc.php';

$email = $_POST['email'];
$username = $_POST['username'];
$password1 = $_POST['password1'];
$password2 = $_POST['password2'];
echo $password1, $password2;

//checks if password and confirm password is the same
if ($password1 === $password2){
    $password = $password1;
} else{
    $_SESSION['login_attempt'] = false;
    $_SESSION['error'] = 'Password and confirm password not matching';
    header("Location: ../index.php?filename=signup");
    exit();
}

//resetting variables
$_SESSION['error'] = '';

$existEmail = false;
$sql = 'SELECT COUNT(*) FROM users WHERE email = ?';
$stmt = prepared_query($conn, $sql, [$email], 's');
$stmt->execute();
$stmt->bind_result($existEmail);
$stmt->fetch();
$stmt->close();

$existUsername = false;
$sql = 'SELECT COUNT(*) FROM users WHERE username = ?';
$stmt = prepared_query($conn, $sql, [$username], 's');
$stmt->execute();
$stmt->bind_result($existUsername);
$stmt->fetch();
$stmt->close();

if ($existEmail == true){
    $_SESSION['login_attempt'] = false;
    $_SESSION['error'] = 'Email already exists';
    header("Location: ../index.php?filename=signup");
}
if ($existUsername == true){
    $_SESSION['login_attempt'] = false;
    $_SESSION['error'] = 'Username already exists';
    header("Location: ../index.php?filename=signup");
} else{
    //hashing the password
    $salt = 'apsojvpscpoxnkm';
    $hash = hash('sha256', $password . $salt);
    $sql = 'INSERT INTO users VALUES (?, ?, ?, ?, ?, ?)';
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $date = date('Y-m-d H:i:s');
        $stmt = prepared_query($conn, $sql, ['', '', $username, $email, $hash, $date], 'ssssss');
        $stmt->execute();
        $stmt->close();
    }
    $_SESSION['loggedin'] = true;

    //set up session email to recognise user
    $_SESSION['emailUsername'] = $email;


    header("Location: ../index.php?filename=interest");
}
?>