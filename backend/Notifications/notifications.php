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

$sql = "SELECT `notification_id`,`notification_type`,`content`,`sender_id`,`notifications`.`created_at`,`content`
        FROM `notifications` 
        LEFT JOIN `users` ON `sender_id` = `users`.`user_id` 
        LEFT JOIN `user_details` ON `users`.`user_id` = `user_details`.`user_id`
        WHERE `notifications`.`user_id` = ?";

$notifData = executeSelect($mysqli, $sql, "i", [$userId]);
onSuccess($mysqli,true,['notifications'=>$notifData['data']]);
