<?php
session_start();
include_once 'connect.inc.php';

$username = $_POST['email'];
$password = $_POST['password'];

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
    $_SESSION['loggedin'] = true;
    //used to decide ID
    $ID = '';
    $sql = 'SELECT COUNT(*) FROM users';
    $ID = $conn->query($sql);

    $sql = 'INSERT INTO users VALUES (?, ?, ?, ?, ?, ?)';
    $stmt = prepared_query($conn, $sql, [$ID, '', '', $username, $password, date('jS F Y')], 'issssi');
    echo 'HI';
    $stmt->execute();
    $stmt->close();
    header("Location: ../index.php?filename=home");
}
