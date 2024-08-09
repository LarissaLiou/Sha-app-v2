<?php
require_once __DIR__ . "/../Defaults/connect.inc.php";
require_once __DIR__ . "/../Defaults/utils.inc.php";
require_once __DIR__ . "/../Defaults/validate.inc.php";

if (!verify_login($mysqli)) {
    onError($mysqli, "Unauthorized");
}

$presenceCheck = ["recommended", "near me", "interest"];

// First query to fetch event details
$sql = "SELECT `events`.`event_id`, `event_name`, `event_image`, `min_price`, 
               CASE WHEN `max_price` = 0 THEN `min_price` ELSE `max_price` END as `max_price`,
               `min_attendees`, 
               CASE WHEN `max_attendees` = 0 THEN `min_attendees` ELSE `max_attendees` END as `max_attendees`,
               `location`, `start`, `end`, `event_type`
        FROM `events`
        LEFT JOIN `events_types_junction` ON `events`.`event_id` = `events_types_junction`.`event_id`
        LEFT JOIN `event_types` ON `events_types_junction`.`event_type_id` = `event_types`.`event_type_id`
        ";

$result = executeSelect($mysqli, $sql, "", []);
$newData = [];
foreach ($result['data'] as $row){
    if (!isset($newData[$row['event_id']])) {
        $newData[$row['event_id']] = $row;
        $newData[$row['event_id']]['event_type'] = [];
    }
    $newData[$row['event_id']]['event_type'][] = $row['event_type'];
}
$response = array_values($newData);
onSuccess($mysqli, true, ['events' => $response]);


