<?php
require_once __dir__."/../Defaults/connect.inc.php";
require_once __dir__."/../Defaults/utils.inc.php";
require_once __dir__."/../Defaults/validate.inc.php";
require_once __dir__."/../Connect/accept_connection.php";

if (!verify_login($mysqli)){
    onError($mysqli,"Unauthorized");
}

$filterOptions = [
    "notification_id" => FILTER_SANITIZE_NUMBER_INT
];
$presenceCheck = ["notification_id"];

// Testing only
// $inputData = validateData(INPUT_GET, $filterOptions, [], $presenceCheck);
$inputData = validateData(INPUT_POST, $filterOptions, [], $presenceCheck);

$sql = "SELECT (CASE `notification_type` WHEN 2 THEN 1 ELSE 0 END) as is_connect_type,`request_id` FROM `connection_requests` 
       LEFT JOIN `notifications` ON `connection_requests`.`notification_id` = `notifications`.`notification_id`
        WHERE `connection_requests`.`notification_id` = ? AND `user2_id` = ?"; 
$notification = executeSelect($mysqli, $sql, "ii", [$inputData['notification_id'], $_SESSION['userid']]);
if ($notification['num_rows'] == 0){
    onError($mysqli,"Unauthorized");
}
if (!$notification['data'][0]['is_connect_type']){
    onError($mysqli,"Unauthorized");
}
acceptRequest($mysqli,$notification['data'][0]['request_id']);

$sql = "DELETE FROM `notifications` WHERE `notification_id` = ?";
executeDelete($mysqli, $sql, "i", [$inputData['notification_id']]);


onSuccess($mysqli,true);
