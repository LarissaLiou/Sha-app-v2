<?php
require_once __dir__.'/utils.inc.php';
define("SECRET_KEY","uoqcy169(361");
define("salt","vnljh19d1996v");
define("CSRF_TOKEN_SECRET",'wxVy4t0EpypTDfPsEhqXfU92wsjnFce1bLMtbDyKWpbiVXGUp1D');

function validateData($POST_GET, $filters, $validOptions, $presenceCheck,$jsonCheck = []){
    
    $inputData = filter_input_array($POST_GET, $filters);
    if ($inputData === null || $inputData === false) {
        error("Invalid Input");
    }
    $errors = [];
    foreach ($inputData as $key => $value) {
        if ($value === null || $value === false) {
            $errors[] = "Invalid $key ".json_encode($_POST[$key]);
        }
        if (in_array($key, $jsonCheck) && !is_array(json_decode($value))) {
            print_r($key,$value);
            $errors[] = "Invalid JSON $key";
        }
        else if (in_array($key, $jsonCheck)) {
            $inputData[$key] = json_decode($value);
        }

        if (isset($validOptions[$key]) && !in_array($value, $validOptions[$key])) {
            $errors[] = "Invalid $key Option";
        }
        if (in_array($key, $presenceCheck) && empty($value)) {
            $errors[] = "Missing $key";
        }
        
    }
    if (count($errors) > 0) {
        error(implode(", ", $errors));
    }
    return $inputData;
}

function validateSecurity($conn, bool $checkUser, $exitOnError = true){
    
    if ($checkUser){
        $userInfo = verify_login($conn);
        if ($exitOnError && $userInfo === null){
            error("Unauthorized", 401);
        }
        return $userInfo;
    }
}

function rememberMe($conn) {
    $cookie = isset($_COOKIE['rememberme']) ? $_COOKIE['rememberme'] : '';
    // If cookie exists
    if ($cookie) {
        list ($user, $token, $tokenid,$mac) = explode(':', $cookie);
        if (!hash_equals(hash_hmac('sha256', $user . ':' . $token.':'.$tokenid, SECRET_KEY), $mac)) {
            return false;
        }
        $usertoken = fetchTokenByUserName($conn,$user,$tokenid);
        if (!$usertoken) return;
        if (hash_equals($usertoken, hash_hmac("sha256",$token,salt))) {
            $_SESSION["loggedin"] = true;
            $_SESSION["userid"] = $user;
            return true;
        }
        else{
            return false;
        }
    }

}

function destroyCookie($conn){
    
    $cookie = isset($_COOKIE['rememberme']) ? $_COOKIE['rememberme'] : '';
    
    // print_r($_COOKIE);
    if (!$cookie) return false;
    list ($user, $token, $tokenid,$mac) = explode(':', $cookie);
    if (!hash_equals(hash_hmac('sha256', $user . ':' . $token.':'.$tokenid, SECRET_KEY), $mac)) return false;
    
    $SQL = 'DELETE FROM `tokens` WHERE `user_id` = ? AND `token_id` = ?';
    executeDelete($conn,$SQL,"ii",[$user,$tokenid]);
    setcookie("rememberme", "", time()-3600,"/");
}

function fetchTokenByUserName($conn,$user,$tokenid){
    # Finds the user's token in the database
    $SQL = 'SELECT `token` FROM `tokens` WHERE `user_id` = ? AND `token_id` = ?';
    $result = executeSelect($conn,$SQL,"si",[$user,$tokenid]);
    $token = $result['data'][0]['token'];
    return $token;
}

function storeTokenForUser($conn,$user,$token){
    $token = hash_hmac("sha256",$token,salt);
    $SQL = 'INSERT INTO `tokens`(`token`,`user_id`) VALUES (?,?)';
    $result = executeInsert($conn,$SQL,"si",[$token,$user]);
    $tokenid = $result['insertedId'];
    return $tokenid;
}

function GenerateRandomToken($length = 32){
    if(!isset($length) || intval($length) <= 8 ){
      $length = 32;
    }
    if (function_exists('random_bytes')) {
        return bin2hex(random_bytes($length));
    }
    if (function_exists('mcrypt_create_iv')) {
        return bin2hex(mcrypt_create_iv($length, MCRYPT_DEV_URANDOM));
    }
    if (function_exists('openssl_random_pseudo_bytes')) {
        return bin2hex(openssl_random_pseudo_bytes($length));
    }
}

function verify_login($conn){
    // Check if the person is already logged in
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true &&
        isset($_SESSION['userid'])){
        // Extracting user details from db
        $sql = "SELECT `email`,`username` FROM `users` WHERE `user_id` = ?";
        $result = executeSelect($conn,$sql,"i",[$_SESSION['userid']]);
        if ($result['data'] == null) {
            return false;
        }
        $data = $result['data'][0];
        $_SESSION['email'] = $data['email'];
        $_SESSION['username'] = $data['username'];
        return true;
        
        // It will return the data that is fetched
    }
    // person is not logged in
    else{
        if (rememberMe($conn)){
            return verify_login($conn);
        } 
        else return false;
    };
}

function error($error, $code = 400){
    http_response_code($code);
    echo json_encode(["error"=>$error]);
    exit();
}

function success($data){
    echo json_encode(["data"=>$data]);
    exit();
}