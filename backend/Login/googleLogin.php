<?php
require_once __dir__."/../../vendor/autoload.php";
require_once __dir__."/../Defaults/connect.inc.php";
require_once __dir__."/../Defaults/validate.inc.php";

require_once __dir__."/googleLoginInfo.inc.php";

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
function onLogin($conn, $user) {
    $_SESSION['userid'] = $user;
    $token = GenerateRandomToken(128); // Generate a token, should be 128 - 256 bits
    $tokenid = storeTokenForUser($conn, $user, $token);
    $cookie = $user . ':' . $token . ':' . $tokenid;
    $mac = hash_hmac('sha256', $cookie, SECRET_KEY); 
    $cookie .= ':' . $mac;
    setcookie('rememberme', $cookie, [
        'expires' => time() + (10 * 365 * 24 * 60 * 60),
        'path' => "/",
        'secure' => true,
        'httponly' => true
    ]);
}

if (isset($_GET['code'])) {
    session_destroy();
    session_start();

    if (isset($_COOKIE['rememberme'])) {
        setcookie("rememberme", "", time() - 3600, "/");
    }

    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
    if (isset($token["error"])) {
        echo "<script>window.location.href = 'index.php?filename=login'</script>";
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
            // header("Location: /index.php?filename=home");
        } else {
            // Signup the user
        }
    }
}
?>
