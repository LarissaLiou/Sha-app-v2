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

function sendMessage($mysqli,$conversation_id,$content){
    $sql = "INSERT INTO `messages` (`conversation_id`,`sender_id`,`content`) VALUES (?,?,?)";
    executeInsert($mysqli, $sql, "iis", [$conversation_id,$_SESSION['userid'],$content]);
}

if (!verify_login($mysqli)){
    onError($mysqli,"Unauthorized");
}

$filterOptions = [
    "conversation_id" => FILTER_SANITIZE_NUMBER_INT,
    "content" => FILTER_SANITIZE_STRING
];
$presenceCheck = ["conversation_id","content"];

// Testing only
// $inputData = validateData(INPUT_GET, $filterOptions, [], $presenceCheck);
$inputData = validateData(INPUT_POST, $filterOptions, [], $presenceCheck);

checkUserInConversation($mysqli,$inputData['conversation_id'],$_SESSION['userid']);
sendMessage($mysqli,$inputData['conversation_id'],$inputData['content']);
onSuccess($mysqli,true,["last_updated"=>time()]);

