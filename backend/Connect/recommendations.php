<?php
require_once __dir__."/../Defaults/connect.inc.php";
require_once __dir__."/../Defaults/utils.inc.php";
require_once __dir__."/../Defaults/validate.inc.php";

if (!verify_login($mysqli)){
    onError($mysqli,"Unauthorized");
}

$filterOptions = [
    "count" => FILTER_SANITIZE_NUMBER_INT
];
$presenceCheck = ["count"];

$inputData = validateData(INPUT_GET, $filterOptions, [], $presenceCheck);
$sql = "SELECT `users`.`user_id`,`age`,`interest`,`about`,`profile_picture`,`country`,`city` 
        FROM `users` 
        JOIN `user_details` ON `users`.`user_id` = `user_details`.`user_id`
        LEFT JOIN `users_interests_junction` ON `users`.`user_id` = `users_interests_junction`.`user_id`
        LEFT JOIN `interests` ON `users_interests_junction`.`interest_id` = `interests`.`interest_id`
        LEFT JOIN `connections` ON `users`.`user_id` = `connections`.`user1_id` OR `users`.`user_id` = `connections`.`user2_id`
        WHERE `users`.`user_id` != ? and `connections`.`user1_id` IS NULL and `connections`.`user2_id` IS NULL
        ORDER BY RAND() LIMIT ?";

$recommendations = executeSelect($mysqli, $sql, "ii", [$_SESSION['userid'], $inputData['count']]);
onSuccess($mysqli, $recommendations['data']);
