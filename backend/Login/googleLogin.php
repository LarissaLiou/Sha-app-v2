<?php
require_once __dir__."/../../vendor/autoload.php";
require_once __dir__."/../Defaults/connect.inc.php";
require_once __dir__."/../Defaults/validate.inc.php";
require_once __dir__."/login_api.inc.php";

// Determine the origin
$origin = isset($_GET["origin"]) ? $_GET["origin"] : "Login";

// Create a Google Client
$client = new Google_Client();
$client->setClientId(clientID);
$client->setClientSecret(clientSecret);
$client->setRedirectUri(redirecturl);
$client->addScope("profile");
$client->addScope("email");
$client->addScope("openid");
$googleUrl = $client->createAuthUrl();

// Login function


if (isset($_GET['code'])) {
    session_destroy();
    session_start();

    if (isset($_COOKIE['rememberme'])) {
        setcookie("rememberme", "", time() - 3600, "/");
    }

    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
    if (isset($token["error"])) {
        header("Location: /index.php?filename=login&error=Invalid login");
        exit();
    }

    $client->setAccessToken($token);
    $gauth = new Google_Service_Oauth2($client);
    $google_info = $gauth->userinfo->get();

    $email = $google_info->email;
    $name = $google_info->name;
    $picture = $google_info->picture;

    if ($email) {
        // Check if the email exists in the database
        $result = executeSelect($mysqli, "SELECT user_id, COUNT(*) as countof FROM `users` WHERE `email` = ?", "s", [$email], true);

        if ($result['data'][0]['countof'] > 0) {
            $id = $result['data'][0]['user_id'];
            onLogin($mysqli, $id);
            verify_login($mysqli);
            header("Location: index.php?filename=home");
        } else {
            $password = GenerateRandomToken(128);
            $userId = onSignUp($mysqli, $name, $name, $email, $picture, $password);
            onLogin($mysqli, $userId);
            header("Location: index.php?filename=interest");
        }
    }
}
?>
