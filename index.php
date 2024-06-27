<?php
session_start();

$filename = isset($_GET['filename']) ? $_GET['filename'] : "";

switch($filename){
    case 'interest':
        include('templates/interest.html');
        break;

    case 'interest2':
        include('templates/interest2.html');
        break;

    case 'profile':
        include('templates/profile.html');
        break;
    
    default:
        include('templates/home.html');
}