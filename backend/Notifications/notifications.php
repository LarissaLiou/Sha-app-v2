<?php
require_once __dir__."/../Defaults/connect.inc.php";
require_once __dir__."/../Defaults/utils.inc.php";
require_once __dir__."/../Defaults/validate.inc.php";


if (!verify_login($mysqli)){
    onError($mysqli,"Unauthorized");
}
$filterOptions = [
    "userid" => FILTER_SANITIZE_NUMBER_INT
];
$userId = $_SESSION['userid'];

$sql = "SELECT `notification_type`,`content`,`sender_id`,`created_at`,`user_id` FROM `notifications` 
        JOIN `users` ON `sender_id` = `user_id` 
        WHERE `recipient_id` = ?";

$result = executeSelect($mysqli, $sql, "i", [$userId]);
onSuccess($mysqli,true,['requests'=>$result['data']]);
header('Content-Type: application/json');
echo json_encode(['requests' => $result['data']]);
