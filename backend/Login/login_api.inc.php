<?php
require_once __DIR__."/../../../private/sociate_passwords.inc.php";
function verifyLoginCredentials($conn,$username,$password){
    $sql = 'SELECT `password`,`user_id` FROM `users` WHERE `username` = ? OR `email` = ?';
    $result = executeSelect($conn,$sql,"ss",[$username,$username]);
    $passwordHash = $result['data'][0]['password'];
    $userid = $result['data'][0]['user_id'];
    $salt = PASSWORD_SALT;
    $hash = hash('sha256',$password.$salt);
    if (hash_equals($hash,$passwordHash)){
        return $userid;
    }
    return false;
}
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

function onSignUp($mysqli, $user_handle, $username, $email, $profile_picture, $password){
    $hash = hash('sha256', $password . PASSWORD_SALT);
    $sql = 'INSERT INTO users(user_handle,username,email,password) VALUES (?,?,?,?)';
    $data = executeInsert($mysqli, $sql, 'ssss', [$user_handle,$username,$email,$hash]);
    $user_id = $data['insertedId'];
    $sql = 'INSERT INTO user_details(user_id,profile_picture) VALUES (?,?)';
    $data = executeInsert($mysqli, $sql, 'is', [$user_id,$profile_picture]);
    return $user_id;
}