<?php
require_once __dir__."/../Defaults/connect.inc.php";
require_once __dir__."/../Defaults/utils.inc.php";
require_once __dir__."/../Defaults/validate.inc.php";

if (!verify_login($mysqli)){
    onError($mysqli,"Unauthorized");
}
$filterOptions = [
    "user_id" => FILTER_SANITIZE_NUMBER_INT
];
$presenceCheck = ["user_id"];

$sql = "SELECT 
    ud.profile_picture,
    u.username,
    ud.age,
    ud.country,
    ud.city,
    ud.about,
    ud.desc,
    u.user_handle,
    connections.connection_count,
    i.interest
    FROM users u
    JOIN user_details ud ON u.user_id = ud.user_id
    LEFT JOIN (
        SELECT 
            user1_id,
            COUNT(*) as connection_count 
        FROM connections 
        WHERE user1_id = ? OR user2_id = ?
        GROUP BY user1_id
    ) connections ON u.user_id = connections.user1_id
    LEFT JOIN users_interests_junction uij ON u.user_id = uij.user_id
    LEFT JOIN interests i ON uij.interest_id = i.interest_id
    WHERE u.user_id = ?
    ORDER BY i.interest;
    ";

$inputData = validateData(INPUT_GET, $filterOptions, [], $presenceCheck);
$result = executeSelect($mysqli, $sql, "iii", [$inputData['user_id'],$inputData['user_id'],$inputData['user_id']]);
if ($result['num_rows'] == 0){
    onError($mysqli, "No user found");
}
$response = $result['data'][0];
$response['interests'] = [];
for ($i = 0; $i < count($result['data']); $i++){
    if (!empty($result['data'][$i]['interest'])){
        $response['interests'][] = ['interest'=>$result['data'][$i]['interest'],'color'=>generateColor($result['data'][$i]['interest'])];
    }
}
if ($_SESSION['userid'] == $inputData['user_id']){
    $response['is_self'] = true;
}else{
    $response['is_self'] = false;
}
onSuccess($mysqli, true, ['user' => $response]);