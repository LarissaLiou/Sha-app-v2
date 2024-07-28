<?php
include 'connect.inc.php';

function fetch_notifs($conn)
{
    $sql = "SELECT * FROM notifications";
    $stmt = prepared_query($conn, $sql, [], "");
    if ($stmt === false) {
        return null;
    }

    $result = $stmt->get_result();
    if ($result === false) {
        echo "Fetching result error";
        return null;
    }

    $notifications = [];
    while ($row = $result->fetch_assoc()) {
        $notifications[] = $row;
    }

    return json_encode($notifications);
}

header('Content-Type: application/json');
echo fetch_notifs($conn);

$conn->close();
?>
