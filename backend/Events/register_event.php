<?php
require_once __dir__."/../Defaults/connect.inc.php";
require_once __dir__."/../Defaults/utils.inc.php";
require_once __dir__."/../Defaults/validate.inc.php";
function registerEvent($mysqli,$event_id){
    $sql = "INSERT INTO `attendees`(event_id,user_id) VALUES (?,?)";
    executeInsert($mysqli, $sql, "ii", [$event_id,$_SESSION['userid']]);
}

if (!verify_login($mysqli)){
    onError($mysqli,"Unauthorized");
}

$filterOptions = [
    "event_id" => FILTER_SANITIZE_NUMBER_INT
];
$presenceCheck = ["event_id"];

// Testing only
$inputData = validateData(INPUT_GET, $filterOptions, [], $presenceCheck);
// $inputData = validateData(INPUT_POST, $filterOptions, [], $presenceCheck);

registerEvent($mysqli,$inputData['event_id']);
onSuccess($mysqli,true);
