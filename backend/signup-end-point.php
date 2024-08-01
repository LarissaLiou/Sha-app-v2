<?php
session_start();
include_once 'connect.inc.php';

$username = $_POST['email'];
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

$exist = false;
$sql = 'SELECT COUNT(*) FROM users WHERE email = ?';
$stmt = prepared_query($conn, $sql, [$username], 's');
$stmt->execute();
$stmt->bind_result($exist);
$stmt->fetch();
$stmt->close();

if ($exist == true){
    $_SESSION['login_attempt'] = false;
    $_SESSION['error'] = 'Email already exists';
    header("Location: ../index.php?filename=login");
} else{
    //used to decide ID
    $sql = 'INSERT INTO users VALUES (?, ?, ?, ?, ?, ?)';
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $date = date('Y-m-d H:i:s');
        $stmt = prepared_query($conn, $sql, ['', '', '', $username, $password, $date], 'ssssss');
        $stmt->execute();
        $stmt->close();
    }
    $_SESSION['loggedin'] = true;
    header("Location: ../index.php?filename=home");
}
?>