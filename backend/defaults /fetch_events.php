<?php
include 'connect.inc.php';

function fetch_events($conn)
{
    $sql = "SELECT * FROM events";
    $stmt = prepared_query($conn, $sql, [], "");
    if ($stmt === false) {
        return null;
    }

    $result = $stmt->get_result();
    if ($result === false) {
        echo "Fetching result error";
        return null;
    }

    $events = [];
    while ($row = $result->fetch_assoc()) {
        $events[] = $row;
    }

    return json_encode($events);
}

header('Content-Type: application/json');
echo fetch_events($conn);

$conn->close();
?>
