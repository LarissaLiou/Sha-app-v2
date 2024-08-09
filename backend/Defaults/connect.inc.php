<?php
require_once __DIR__."/../../../private/sociate_passwords.inc.php";
$mysqli = new mysqli(SERVERNAME,DB_USER,DB_PASS,DB_NAME);
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
        if ($exitOnError) {
            error('Prepare failed: ' . $mysqli->error);
        }
        return ['success' => false, 'error' => 'Prepare failed: ' . $mysqli->error];
    }

    if (!empty($params)) {
        $bind = $stmt->bind_param($types, ...$params);
        if (!$bind) {
            $stmt->close();
            if ($exitOnError) {
                error('Bind param error: ' . $stmt->error);
            }
            return ['success' => false, 'error' => 'Bind param error: ' . $stmt->error];
        }
    }

    if (!$stmt->execute()) {
        $stmt->close();
        if ($exitOnError) {
            error('Execute error: ' . $stmt->error);
        }
        return ['success' => false, 'error' => 'Execute error: ' . $stmt->error];
    }

    $result = [];
    $meta = $stmt->result_metadata();
    if ($meta) {
        $fields = $meta->fetch_fields();
        $bindVarsArray = [];
        foreach ($fields as $field) {
            $bindVarsArray[] = &$result[$field->name];
        }

        call_user_func_array([$stmt, 'bind_result'], $bindVarsArray);

        $data = [];
        while ($stmt->fetch()) {
            $row = [];
            foreach ($result as $key => $val) {
                $row[$key] = $val;
            }
            $data[] = $row;
        }
    } else {
        if ($exitOnError) {
            error('Fetch metadata error: ' . $stmt->error);
        }
        $stmt->close();
        return ['success' => false, 'error' => 'Fetch metadata error: ' . $stmt->error];
    }

    $stmt->close();
    return ['success' => true, 'data' => $data, 'num_rows' => count($data)];
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