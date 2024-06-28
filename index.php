<?php
session_start();

$filename = isset($_GET['filename']) ? $_GET['filename'] : "";

// $loggedIn = 

switch($filename){
    case 'login':
        include('templates/login Pages/login.tpl.php');
        break;

    case 'signup':
        include('templates/login Pages/signup.tpl.php');
        break;

    case 'interest':
        include('templates/interest.tpl.php');
        break;

    case 'interest2':
        include('templates/interest2.tpl.php');
        break;

    case 'profile':
        include('templates/profile.tpl.php');
        break;

    case 'connect':
        include('templates/connect.tpl.php');
        break;
    
    default:
        include('templates/home.tpl.php');
}

include 'templates/footer/footer.tpl.php';