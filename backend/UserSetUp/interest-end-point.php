<?php
session_start();
require_once __dir__."/../Defaults/connect.inc.php";
require_once __dir__."/../Defaults/utils.inc.php";
require_once __dir__."/../Defaults/validate.inc.php";
if (!verify_login($mysqli)){
    onError($mysqli,"Unauthorized");
}

function insertInterestIfNotExists($conn, $interest){
    // BADDDDD implementation. Will change in future
    $sql = 'SELECT `interest_id` FROM interests WHERE interest = ?';
    $res = executeSelect($conn, $sql, 's', [$interest]);
    $interest_id = null;
    if ($res['num_rows'] == 0){
        $sql = "INSERT INTO interests (interest) VALUES (?)";
        $res = executeInsert($conn, $sql, 's', [$interest]);
        $interest_id = $res['insertedId'];
    }
    else{
        $interest_id = $res['data'][0]['interest_id'];
    }
    return $interest_id;
}

$interest = $_POST['selectedInterest'];
$interest = json_decode($interest);
$user_id = $_SESSION['userid'];

for ($i = 0; $i < count($interest); $i++){
    $interest_id = insertInterestIfNotExists($mysqli, $interest[$i]);
    $sql = 'INSERT IGNORE INTO users_interests_junction (user_id, interest_id) VALUES (?, ?)';
    $res = executeInsert($mysqli, $sql, 'ii', [$user_id, $interest_id]);
}
header('Location: ../../index.php?filename=skillsets');
