<?php
require_once __dir__."/../Defaults/connect.inc.php";
require_once __dir__."/../Defaults/utils.inc.php";
require_once __dir__."/../Defaults/validate.inc.php";

if (!verify_login($mysqli)){
    onError($mysqli,"Unauthorized");
}
$userId = $_SESSION['userid'];

$sql = "SELECT `request_id`,`sender_id`,`username`,`sent_at` FROM `message_requests` 
        JOIN `users` ON `sender_id` = `user_id` 
        WHERE `recipient_id` = ?";

$result = executeSelect($mysqli, $sql, "i", [$userId]);
onSuccess($mysqli,true,['requests'=>$result['data']]);
