<?php 
require_once __dir__."/../Defaults/validate.inc.php";
require_once __dir__."/../Defaults/connect.inc.php";
require_once __dir__."/../Defaults/utils.inc.php";

$filters = [
    "experiences" => FILTER_REQUIRE_ARRAY
];

$presenceCheck = ["experiences"];

if (!verify_login($mysqli)){
    onError($mysqli,"Unauthorized");
}

$inputData = validateData(INPUT_POST, $filters, [], $presenceCheck);
$sql = "DELETE FROM `users_experiences` WHERE `user_id` = ?";
executeDelete($mysqli, $sql, "i", [$_SESSION['userid']]);
foreach ($inputData['experiences'] as $experience){
    $sql = "INSERT INTO `users_experiences` (`user_id`, `position`,`organisation`,`started`,`ended`) VALUES (?, ?, ?, ?, ?)";
    executeInsert($mysqli, $sql, "issss", [$_SESSION['userid'], $experience['position'], $experience['organisation'], $experience['started'], $experience['ended']]);
}
onSuccess($mysqli,"Profile Updated");
