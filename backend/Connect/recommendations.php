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
$sql = "SELECT `users`.`user_id`,`age`,`interest`,`about`,`profile_picture`,`country`,`city`,`username` 
        FROM `users` 
        JOIN `user_details` ON `users`.`user_id` = `user_details`.`user_id`
        LEFT JOIN `users_interests_junction` ON `users`.`user_id` = `users_interests_junction`.`user_id`
        LEFT JOIN `interests` ON `users_interests_junction`.`interest_id` = `interests`.`interest_id`
        LEFT JOIN `connections` ON `users`.`user_id` = `connections`.`user1_id` OR `users`.`user_id` = `connections`.`user2_id`
        WHERE `users`.`user_id` != ? and `connections`.`user1_id` IS NULL and `connections`.`user2_id` IS NULL
        ORDER BY RAND() LIMIT ?";

$recommendations = executeSelect($mysqli, $sql, "ii", [$_SESSION['userid'], $inputData['count']])['data'];
$formattedRecommendations = [];

foreach ($recommendations as $row) {
    $userId = $row['user_id'];
    if (!isset($formattedRecommendations[$userId])) {
        $formattedRecommendations[$userId] = [
            'user_id' => $row['user_id'],
            'age' => $row['age'],
            'about' => $row['about'],
            'profile_picture' => $row['profile_picture'],
            'country' => $row['country'],
            'city' => $row['city'],
            'username' => $row['username'],
            'interests' => []
        ];
    }

    if (!empty($row['interest'])) {
        $hash = md5($row['interest']);
        $color = "#" + substr($hash, 0, 6);
        $formattedRecommendations[$userId]['interests'][] = ['interest'=>$row['interest'],'color'=>$colors];
    }
}

$finalRecommendations = array_values($formattedRecommendations);

onSuccess($mysqli, true, ["profiles"=>$finalRecommendations]);
