<?php
session_start();
include_once 'connect.inc.php';

$interest = $_POST['selectedInterest'];

//retrieve user id
$user_id = '';
$sql = 'SELECT user_id FROM users WHERE email = ? OR username = ?';
$stmt = prepared_query($conn, $sql, [$_SESSION['emailUsername'], $_SESSION['emailUsername']], 'ss');
$stmt->execute();
$stmt->bind_result($user_id);
$stmt->fetch();
$stmt->close();


//insert into interest table
$interest_id = $user_id; //interest_id = user_id
$sql = 'INSERT INTO interests VALUES (?, ?)';
$stmt = prepared_query($conn, $sql, [$interest_id, $interest], 'is');
$stmt->execute();
$stmt->close();

//interest into interest junction table
$sql = 'INSERT INTO users_interests_junction VALUES (?, ?)';
$stmt = prepared_query($conn, $sql, [$user_id, $interest_id], 'ii');
$stmt->execute();
$stmt->close();


header('Location: ../index.php?filename=interest2');
?>