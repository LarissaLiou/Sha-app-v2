<?php
require_once '../Defaults/validate.inc.php';
require_once '../Defaults/connect.inc.php';

$sqlUsers = "SELECT `user_id`,`user_handle`,`username` FROM `users`";
$sqlEvents = "SELECT `event_id`,`event_name`,`min_price`,`max_price`,`min_attendees`,`max_attendees`,`description`,`location`,`start`,`end` 
        FROM `events` 
        LEFT JOIN `event_types_junction` ON `events`.`event_id` = `event_types_junction`.`event_id`
        LEFT JOIN `event_types` ON `event_types_junction`.`event_type_id` = `event_types`.`event_type_id`
        ";

$userData = executeSelect($mysqli, $sqlUsers, '', [], true)['data'];
$eventData = executeSelect($mysqli, $sqlEvents, '', [], true)['data'];
$events = [];
while ($row = $eventData->fetch_assoc()) {
    $eventId = $row['event_id'];
    if (!isset($events[$eventId])) {
        $events[$eventId] = [
            'event_id' => $row['event_id'],
            'event_name' => $row['event_name'],
            'event_description' => $row['event_description'],
            'event_date' => $row['event_date'],
            'event_time' => $row['event_time'],
            'event_location' => $row['event_location'],
            'event_type' => [], 
        ];
    }
    if ($row['event_type']) {
        $events[$eventId]['event_type'][] = [
            'event_type_id' => $row['event_type_id'],
            'event_type' => $row['event_type'],
        ];
    }
}

echo json_encode(['users' => $userData, 'events' => $events]);
