<?php
$servername = "localhost";
$username = "root";
$password = "";
$db_name = "sociate";
$mysqli = new mysqli($servername, $username, $password, $db_name);
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}
function executeInsert($mysqli, $sql, $types, $params, $exitOnError = false)
{
    // Prepare the SQL statement
    $stmt = $mysqli->prepare($sql);
    if (!$stmt) {
        // Return error information
        if ($exitOnError) {
            error('Prepare failed: ' . $mysqli->error);
        }
        return ['success' => false, 'error' => 'Prepare failed: ' . $mysqli->error];
    }
    if (!empty($params)) {
        // Bind parameters to the prepared statement
        $bind = $stmt->bind_param($types, ...$params);
        if (!$bind) {
            // Close statement and return error information
            $stmt->close();
            if ($exitOnError) {
                error('Bind param error: ' . $stmt->error);
            }
            return ['success' => false, 'error' => 'Bind param error: ' . $stmt->error];
        }
    }
    // Execute the prepared statement
    $execute = $stmt->execute();
    if (!$execute) {
        // Close statement and return error information
        $stmt->close();
        if ($exitOnError) {
            error('Execute error: ' . $stmt->error);
        }
        return ['success' => false, 'error' => 'Execute error: ' . $stmt->error];
    }

    // Get the inserted ID
    $insertedId = $mysqli->insert_id;

    // Close the prepared statement
    $stmt->close();

    // Return the success status and inserted ID
    return ['success' => true, 'insertedId' => $insertedId];
}

function executeSelect($mysqli, $sql, $types, $params, $exitOnError = false)
{
    $stmt = $mysqli->prepare($sql);
    if (!$stmt) {
        // Return error information
        if ($exitOnError) {
            error('Prepare failed: ' . $mysqli->error);
        }
        return ['success' => false, 'error' => 'Prepare failed: ' . $mysqli->error];
    }

    // Bind parameters to the prepared statement
    if (!empty($params)) {
        $bind = $stmt->bind_param($types, ...$params);
        if (!$bind) {
            // Close statement and return error information
            $stmt->close();
            if ($exitOnError) {
                error('Bind param error: ' . $stmt->error);
            }
            return ['success' => false, 'error' => 'Bind param error: ' . $stmt->error];
        }
    }
    // Execute the prepared statement
    $execute = $stmt->execute();
    if (!$execute) {
        // Close statement and return error information
        $stmt->close();
        if ($exitOnError) {
            error('Execute error: ' . $stmt->error);
        }
        return ['success' => false, 'error' => 'Execute error: ' . $stmt->error];
    }

    // Get the result
    $result = $stmt->get_result();
    $data = $result->fetch_all(MYSQLI_ASSOC);

    // Close the prepared statement
    $stmt->close();

    // Return the success status and data
    return ['success' => true, 'data' => $data];
}

function executeDelete($mysqli, $sql, $types, $params, $exitOnError = false)
{
    $stmt = $mysqli->prepare($sql);
    if (!$stmt) {
        // Return error information
        if ($exitOnError) {
            error('Prepare failed: ' . $mysqli->error);
        }
        return ['success' => false, 'error' => 'Prepare failed: ' . $mysqli->error];
    }

    // Bind parameters to the prepared statement
    if (!empty($params)) {
        $bind = $stmt->bind_param($types, ...$params);
        if (!$bind) {
            // Close statement and return error information
            $stmt->close();
            if ($exitOnError) {
                error('Bind param error: ' . $stmt->error);
            }
            return ['success' => false, 'error' => 'Bind param error: ' . $stmt->error];
        }
    }
    // Execute the prepared statement
    $execute = $stmt->execute();
    if (!$execute) {
        // Close statement and return error information
        $stmt->close();
        if ($exitOnError) {
            error('Execute error: ' . $stmt->error);
        }
        return ['success' => false, 'error' => 'Execute error: ' . $stmt->error];
    }

    // Close the prepared statement
    $stmt->close();

    // Return the success status
    return ['success' => true];
}