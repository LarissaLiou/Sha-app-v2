<?php
require_once __dir__."/../Defaults/connect.inc.php";
require_once __dir__."/../Defaults/utils.inc.php";
require_once __dir__."/../Defaults/validate.inc.php";
function verifyRequest($mysqli,$request_id,$user_id){
    $sql = "SELECT `request_id` FROM `message_requests` WHERE `request_id` = ? AND `recipient_id` = ?";
    $result = executeSelect($mysqli, $sql, "ii", [$request_id,$user_id]);
    if ($result['num_rows'] == 0){
        onError($mysqli,"Unauthorized");
    }
}
function acceptMessageRequest($mysqli,$request_id){
    $sql = "INSERT INTO `conversations`(user1_id,user2_id) SELECT `sender_id`, `recipient_id` FROM `message_requests` WHERE `request_id` = ?";
    executeInsert($mysqli, $sql, "i", [$request_id]);

    $sql = "DELETE FROM `message_requests` WHERE `request_id` = ?";
    executeDelete($mysqli, $sql, "i", [$request_id]);

    
}

if (!verify_login($mysqli)){
    onError($mysqli,"Unauthorized");
}

$filterOptions = [
    "request_id" => FILTER_SANITIZE_NUMBER_INT
];
$presenceCheck = ["request_id"];

// Testing only
// $inputData = validateData(INPUT_GET, $filterOptions, [], $presenceCheck);
$inputData = validateData(INPUT_POST, $filterOptions, [], $presenceCheck);

verifyRequest($mysqli,$inputData['request_id'],$_SESSION['userid']);
acceptMessageRequest($mysqli,$inputData['request_id']);
onSuccess($mysqli,true);
