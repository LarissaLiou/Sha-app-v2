
<?php
session_start();
$string_version = implode(',', $_SESSION);
include_once 'connect.inc.php';

$username = $_SESSION['username'];
//resetting variables
$_SESSION['error'] = '';

// check user in the database
$exist = false;
$sql = 'SELECT COUNT(*) FROM users WHERE email = ?';
$stmt = prepared_query($conn, $sql, [$username], 's');
$stmt->execute();
$stmt->bind_result($exist);
$stmt->fetch();
$stmt->close();

// get javascript array
$input=file_get_contents("php://input");
$response = [];

if ($exist == true){
    $_SESSION['login_attempt'] = false;

    // decode interest name
    $interest_name=json_decode($input, true);
    $response['decoded_input'] = $interest_name;
    $response['session_value'] = $string_version;
    // echo $response['decoded_input'];

    $sql =  "INSERT INTO users_interests_junction (`user_id`, `interest_id`) 
             VALUES  (
                     (select `user_id` from users where `email` = ?),
                     (select `interest_id` from interests where `interest_name` = ?)
                     )
            ";
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $successAddInterest = false;
        $stmt = prepared_query($conn, $sql, [$username, $interest_name], 'ss');
        $stmt->execute();
        $stmt->bind_result($successAddInterest);
        $stmt->close();
        if ($successAddInterest == true) {
            echo json_encode(["success"=>true, "message"=>"Student Add Successfully"]);
            header("Location: ../index.php?filename=home");
        } else {
            echo json_encode(["success"=>false, "message"=>"Server Problem"]);
        }
    }
} else {
    $_SESSION['error'] = 'Could not find user in the database';    
    $_SESSION['loggedin'] = true;
    header("Location: ../index.php?filename=login");
    echo json_encode(["success"=>false, "message"=>"Couldn't find user"]);    
}
?>
