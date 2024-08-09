<?php 
require_once __dir__."/../Defaults/validate.inc.php";
require_once __dir__."/../Defaults/connect.inc.php";
require_once __dir__."/../Defaults/utils.inc.php";

$filters = [
    "about" => FILTER_SANITIZE_STRING
];

$presenceCheck = ["about"];

if (!verify_login($mysqli)){
    onError($mysqli,"Unauthorized");
}

$inputData = validateData(INPUT_POST, $filters, [], $presenceCheck);
$sql = "UPDATE `user_details` SET `about` = ? WHERE `user_id` = ?";
executeInsert($mysqli, $sql, "si", [$inputData['about'], $_SESSION['userid']]);
onSuccess($mysqli,"Profile Updated");
