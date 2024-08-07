<?php
session_start();
include_once 'connect.inc.php';

$skillset = $_POST['selectedSkillset'];

//retrieve user id
$user_id = '';
$sql = 'SELECT user_id FROM users WHERE email = ? OR username = ?';
$stmt = prepared_query($conn, $sql, [$_SESSION['emailUsername'], $_SESSION['emailUsername']], 'ss');
$stmt->execute();
$stmt->bind_result($user_id);
$stmt->fetch();
$stmt->close();


//insert into interest table
$skillset_id = $user_id; //interest_id = user_id
$sql = 'INSERT INTO skillsets VALUES (?, ?)';
$stmt = prepared_query($conn, $sql, [$skillset_id, $skillset], 'is');
$stmt->execute();
$stmt->close();

//interest into interest junction table
$sql = 'INSERT INTO users_skillset_junction VALUES (?, ?)';
$stmt = prepared_query($conn, $sql, [$user_id, $skillset_id], 'ii');
$stmt->execute();
$stmt->close();


header('Location: ../index.php?filename=home');
?>