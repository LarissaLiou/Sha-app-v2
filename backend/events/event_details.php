<?php
require_once __dir__."/../Defaults/connect.inc.php";
require_once __dir__."/../Defaults/utils.inc.php";
require_once __dir__."/../Defaults/validate.inc.php";

if (!verify_login($mysqli)){
    onError($mysqli,"Unauthorized");
}
$filterOptions = [
    "event_id" => FILTER_SANITIZE_NUMBER_INT
];
$presenceCheck = ["event_id"];

$eventId = $_GET['event_id'] ?? 0;
$sql = "SELECT `events`.`event_id`, `event_name`, `event_image`, `min_price`, 
               CASE WHEN `max_price` = 0 THEN `min_price` ELSE `max_price` END as `max_price`,
               `min_attendees`, 
               CASE WHEN `max_attendees` = 0 THEN `min_attendees` ELSE `max_attendees` END as `max_attendees`,
               `location`, `start`, `end`, `event_type`,
                `description`, `event_link`,`location`
        FROM `events`
        LEFT JOIN `events_types_junction` ON `events`.`event_id` = `events_types_junction`.`event_id`
        LEFT JOIN `event_types` ON `events_types_junction`.`event_type_id` = `event_types`.`event_type_id`
        WHERE `events`.`event_id` = ?
        ";

$result = executeSelect($mysqli, $sql, "i", [$eventId]);
if ($result['num_rows'] == 0){
    onError($mysqli, "No event found");
}

$response = $result['data'][0];
$response['event_type'] = [];
foreach ($result['data'] as $row){
    $response['event_type'][] = $row['event_type'];
}


onSuccess($mysqli, true, ['event' => $response]);