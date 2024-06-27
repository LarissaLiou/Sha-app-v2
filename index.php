<?php
session_start();

$filename = isset($_GET['filename']) ? $_GET['filename'] : "";

switch($filename){
    case 'interest':
        include('templates/interest.tpl.php');
        break;

    case 'interest2':
        include('templates/interest2.tpl.php');
        break;

    case 'profile':
        include('templates/profile.tpl.php');
        break;
    
    default:
        include('templates/home.tpl.php');
}

include 'templates/footer/footer.tpl.php';