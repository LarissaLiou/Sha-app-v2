<?php
session_start();
$_SESSION['loggedin'] = false;
setcookie('rememberme', '', time() - 3600, '/');
header('Location: index.php?filename=login');
