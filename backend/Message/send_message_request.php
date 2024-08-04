<?php
require_once __dir__."/../Defaults/connect.inc.php";
require_once __dir__."/../Defaults/utils.inc.php";
require_once __dir__."/../Defaults/validate.inc.php";

if (!verify_login($mysqli)){
    onError($mysqli,"Unauthorized");
}

$filterOptions = [
    "user_id" => FILTER_SANITIZE_NUMBER_INT
];
$presenceCheck = ["user_id"];

// Testing only
// $inputData = validateData(INPUT_GET, $filterOptions, [], $presenceCheck);
$inputData = validateData(INPUT_POST, $filterOptions, [], $presenceCheck);

$sql = "INSERT IGNORE INTO `message_requests` (`sender_id`, `recipient_id`) VALUES (?, ?)";
$result = executeInsert($mysqli, $sql, "ii", [$_SESSION['userid'], $inputData['user_id']],$exitOnError = true);
if (!$result['insertedId']){
    onError($mysqli,"Request already sent");
}

onSuccess($mysqli,true);
