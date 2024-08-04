<?php
require_once __dir__."/../Defaults/connect.inc.php";
require_once __dir__."/../Defaults/utils.inc.php";
require_once __dir__."/../Defaults/validate.inc.php";
function checkUserInConversation($mysqli,$conversation_id,$user_id){
    $sql = "SELECT `conversation_id` FROM `conversations` WHERE `conversation_id` = ? AND (`user1_id` = ? OR `user2_id` = ?)";
    $result = executeSelect($mysqli, $sql, "iii", [$conversation_id,$user_id,$user_id]);
    if ($result['num_rows'] == 0){
        onError($mysqli,"Unauthorized");
    }
}

function getMessages($mysqli,$conversation_id,$last_updated,$user_id){
    $sql = "SELECT `message_id`,`sender_id`,`content`,`sent_at`,`is_read`,`username`,`profile_picture`,
            (CASE WHEN `sender_id` = ? THEN 1 ELSE 0 END) as `is_you`
            FROM `messages`
            LEFT JOIN `users` ON `sender_id` = `users`.`user_id`
            LEFT JOIN `user_details` ON `user_details`.`user_id` = `sender_id`
            WHERE `conversation_id` = ? AND `sent_at` > ?";
    $result = executeSelect($mysqli, $sql, "iii", [$user_id,$conversation_id,$last_updated],true);
    print_r($result);
    return $result['data'];
}

if (!verify_login($mysqli)){
    onError($mysqli,"Unauthorized");
}
$filterOptions = [
    "conversation_id" => FILTER_SANITIZE_NUMBER_INT,
    "last_updated" => FILTER_SANITIZE_NUMBER_INT
];
$presenceCheck = ["conversation_id"];
$inputData = validateData(INPUT_GET, $filterOptions, [], $presenceCheck);

$userId = $_SESSION['userid'];

checkUserInConversation($mysqli,$inputData['conversation_id'],$userId);
$conversations = getMessages($mysqli,$inputData['conversation_id'],$inputData['last_updated'],$userId);
onSuccess($mysqli, true,['messages'=>$conversations]);

