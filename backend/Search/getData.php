<?php
require_once '../Defaults/validate.inc.php';
require_once '../Defaults/connect.inc.php';

$sqlUsers = "SELECT `users`.`user_id`,`user_handle`,`username`,`profile_picture` FROM `users`
            LEFT JOIN `user_details` ON `users`.`user_id` = `user_details`.`user_id`";
$sqlEvents = "SELECT `events`.`event_id`,`event_name`,`event_image`,`min_price`,`max_price`,`min_attendees`,
            `max_attendees`,`description`,`location`,`start`,`end`,
            `event_types`.`event_type_id`,`event_types`.`event_type` 
            FROM `events` 
            LEFT JOIN `events_types_junction` ON `events`.`event_id` = `events_types_junction`.`event_id`
            LEFT JOIN `event_types` ON `events_types_junction`.`event_type_id` = `event_types`.`event_type_id`
            ";

$userData = executeSelect($mysqli, $sqlUsers, '', [], true)['data'];
$eventData = executeSelect($mysqli, $sqlEvents, '', [], true)['data'];
$events = [];
foreach ($eventData as $row) {
    $eventId = $row['event_id'];
    if (!isset($events[$eventId])) {
        $events[$eventId] = [
            'event_id' => $eventId,
            'event_image' => $row['event_image'],
            'event_name' => $row['event_name'],
            'min_price' => $row['min_price'],
            'max_price' => $row['max_price'],
            'min_attendees' => $row['min_attendees'],
            'max_attendees' => $row['max_attendees'],
            'description' => $row['description'],
            'location' => $row['location'],
            'start' => $row['start'],
            'end' => $row['end'],
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
