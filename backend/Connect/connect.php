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

$sql = "SELECT `user1_id`,`user2_id` FROM `connection_requests` WHERE `user1_id` = ? AND `user2_id` = ?";
$connection = executeSelect($mysqli, $sql, "ii", [$_SESSION['userid'], $inputData['user_id']]);
if ($connection['num_rows'] > 0){
    onError($mysqli,"Request already sent");
}
$sql = "INSERT INTO `notifications` (`user_id`,`sender_id`,`notification_type`,`content`) VALUES (?,?,2,?)";
$username = $_SESSION['username'];
$result = executeInsert($mysqli, $sql, "iis", [$inputData['user_id'], $_SESSION['userid'], $username." Sent you a connection request"]);
$notification_id = $result['insertedId'];

$sql = "INSERT INTO `connection_requests` (`user1_id`, `user2_id`, `notification_id`) VALUES (?, ? , ?)";
$result = executeInsert($mysqli, $sql, "iii", [$_SESSION['userid'], $inputData['user_id'], $notification_id]);

onSuccess($mysqli,true);
