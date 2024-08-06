<?php

    session_start();
    $string_version = implode(',', $_SESSION);
    // echo $string_version . "<br>";
    // echo $_SESSION["email"] . "<br>";
    // echo $_SESSION["password"] . "<br>";


    include_once "connect.inc.php";

// if(isset($_POST['name']) || isset($_POST['age']) || isset($_POST['country'])){
    $input=file_get_contents("php://input");
    $response = [];

    $decoded_input=json_decode($input, true);
    $response['decoded_input'] = $decoded_input;
    $response['session_value'] = $string_version;

    $username=$_SESSION['username'];
    // $password=$_SESSION['password'];
    // $email=$_SESSION['email'];

    $sql=   "INSERT INTO user_interest_junction (`user`, `interest`) 
            VALUES ((select `user_id` from users where `username` = '{$username}'),(select `interest_id` from interests where `name` = '{$decoded_input}'))
            ";
    $run_sql=mysqli_query($conn,$sql);
    // echo $run_sql;

    // $sql=   "select `interest_id` from interests where `name` = '{$decoded_input}'";
    // $run_sql=mysqli_query($conn,$sql);

    // if ($row = $run_sql->fetch_assoc()) {
    //     echo implode(',', $row);
    // }


    if($run_sql){
        echo json_encode(["success"=>true, "message"=>"Successfully added '{$decoded_input}' to username: '{$username}'"]);
        header("Location: ../index.php?filename=home");
    } else {
        echo json_encode(["success"=>false, "message"=>"Failed to add '{$decoded_input}' to username: '{$username}'"]);
    }
// }

?>