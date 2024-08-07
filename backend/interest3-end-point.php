<?php
session_start();
$jsonArray = $_POST['interestsArray'];
$interestArray = json_decode($jsonArray, true);
// print_r($interestArray); // Just to see what was received
// echo $jsonArray;
// echo $interestArray;
include_once 'connect.inc.php';
$username = $_SESSION['username'];

$exist = false;
$sql = 'SELECT COUNT(*) FROM users WHERE email = ?';
$stmt = prepared_query($conn, $sql, [$username], 's');
$stmt->execute();
$stmt->bind_result($exist);
$stmt->fetch();
$stmt->close();

if ($exist == true) {
    $conn->begin_transaction();

    try {foreach ($interestArray as $interest){
        echo"$interest <br>";
        $successAddInterest = false;
        $sql =  "INSERT INTO users_interests_junction (`user_id`, `interest_id`) 
             VALUES  (
                     (select `user_id` from users where `email` = ?),
                     (select `interest_id` from interests where `interest_name` = ?)
                     )
            ";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('is', $username, $interest);
        if (!$stmt->execute()) {
            throw new Exception('Insert failed: ' . $stmt->error);
        }
         $stmt->close();
    }
    $conn->commit();

    // Redirect to home page
    header("Location: ../index.php?filename=home");
    exit;
    } catch (Exception $e) {
        $conn->rollback();
        echo $e;
        // Handle error (e.g., log it, display a message to the user)
        $_SESSION['error'] = "Failed to add interests. Please try again.: '{$e}'";
        header("Location: ../index.php?filename=error");
        exit;
    }
}
?>