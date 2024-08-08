<?php
// Enable CORS for local development (optional)
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

// Parse the URL to get the path
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode('/', $uri);
$endpoint = $_GET['endpoint'];
// Get the HTTP method
$method = $_SERVER['REQUEST_METHOD'];

// Include the necessary controller based on the request
switch ($endpoint) {
    case 'getData':
        require 'getData.php';
        break;
    default:
        // Invalid endpoint
        header("HTTP/1.1 404 Not Found");
        break;

}


