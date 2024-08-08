<?php
require_once __DIR__ . "/../Defaults/connect.inc.php";
require_once __DIR__ . "/../Defaults/utils.inc.php";
require_once __DIR__ . "/../Defaults/validate.inc.php";

if (!verify_login($mysqli)) {
    onError($mysqli, "Unauthorized");
}

$presenceCheck = ["recommended", "near me", "interest"];

$eventId = $_GET['event_id'] ?? 0;
$eventTypeId = $_GET['event_type_id'] ?? 0;

// First query to fetch event details
$sql1 = "SELECT `event_id`, `event_name`, `event_image`, `min_price`, 
               CASE WHEN `max_price` = 0 THEN `min_price` ELSE `max_price` END as `max_price`,
               `min_attendees`, 
               CASE WHEN `max_attendees` = 0 THEN `min_attendees` ELSE `max_attendees` END as `max_attendees`,
               `location`, `start`, `end`
        FROM `events` 
        WHERE `event_id` = ?";

$result1 = executeSelect($mysqli, $sql1, "i", [$eventId]);

// Second query to fetch event type details
$sql2 = "SELECT `event_type_id`, `event_type` 
        FROM `event_types`
        WHERE `event_type_id` = ?";

$result2 = executeSelect($mysqli, $sql2, "i", [$eventTypeId]);

// Combine the results
$response = [
    'event_details' => $result1['data'],
    'event_type_details' => $result2['data']
];

onSuccess($mysqli, true, ['requests' => $response]);

$mysqli->close();
