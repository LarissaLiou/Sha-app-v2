<?php
require_once 'backend/Defaults/connect.inc.php';
require_once 'backend/Defaults/utils.inc.php';
require_once 'backend/Defaults/validate.inc.php';
session_start();

$filename = isset($_GET['filename']) ? $_GET['filename'] : "";

$loggedIn = verify_login($mysqli);


if ($loggedIn){
    $userData = getUserData($mysqli,$_SESSION['userid']);
    switch($filename){
        // case 'login':
        //     include('templates/login Pages/login.tpl.php');
        //     break;

        // case 'signup':
        //     include('templates/login Pages/signup.tpl.php');
        //     break;

        case 'home':
            include('templates/home.tpl.php');
            break;

        case 'interest':
            include('templates/interest.tpl.php');
            break;

        case 'skillsets':
            include('templates/skillsets.tpl.php');
            break;

        case 'profile':
            include('templates/profile.tpl.php');
            break;

        case 'connect':
            include('templates/connect.tpl.php');
            break;

        case 'eventInformation':
            include('templates/eventInformation.tpl.php');
            break;

        case 'notification':
            include('templates/notification.tpl.php');
            break;

        case 'message':
            include('templates/message.tpl.php');
            break;

        case 'messageEach':
            include('templates/messageEach.tpl.php');
            break;
        
        case "search":
            include('templates/search.tpl.php');
            break;
        case "logout":
            include('backend/Login/logout-end-point.php');
        case "login":
            include('templates/login Pages/login.tpl.php');
            break;
        case "signup":
            include('templates/login Pages/signup.tpl.php');
            break;
        default:
            include('templates/home.tpl.php');
    }

    include 'templates/footer/footer.tpl.php';
} else{
    // session_reset();
    switch($filename){
        case 'login':
            include('templates/login Pages/login.tpl.php');
            break;

        case 'signup':
            include('templates/login Pages/signup.tpl.php');
            break;

        default:
            include('templates/login Pages/login.tpl.php');
    }
    
}