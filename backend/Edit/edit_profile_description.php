<?php 
require_once __dir__."/../Defaults/validate.inc.php";
require_once __dir__."/../Defaults/connect.inc.php";
require_once __dir__."/../Defaults/utils.inc.php";

$filters = [
    "field" => FILTER_SANITIZE_NUMBER_INT,
    "value" => FILTER_SANITIZE_STRING
];

$presenceCheck = ["field"];

$validOptions = [
    "field" => [1,2,3,4,5]
];
if (!verify_login($mysqli)){
    onError($mysqli,"Unauthorized");
}

$inputData = validateData(INPUT_POST, $filters, $validOptions, $presenceCheck);
switch ($inputData['field']){
    case 1:
        // Update Status 
        $sql = "UPDATE `users_details` SET `status` = ? WHERE `user_id` = ?";
        executeInsert($mysqli, $sql, "si", [$inputData['value'], $_SESSION['userid']]);
        break;
    case 2:
        // Update Country
        $sql = "UPDATE `users_details` SET `country` = ? WHERE `user_id` = ?";
        executeInsert($mysqli, $sql, "si", [$inputData['value'], $_SESSION['userid']]);
        break;
    case 3:
        // Update City
        $sql = "UPDATE `users_details` SET `city` = ? WHERE `user_id` = ?";
        executeInsert($mysqli, $sql, "si", [$inputData['value'], $_SESSION['userid']]);
        break;
    default:
        onError($mysqli,"Invalid Field");
        break;
}

onSuccess($mysqli,"Profile Updated");