<?php
$con = mysqli_connect("localhost","root","","sociatedb");//127.0.0.1  if not localhost
$response = array();
if($con){
    $sql = "select * from notifications";
    $result = mysqli_query($con,$sql);
    if(mysqli_num_rows($result)>0)
    header('Content-type: application/json');
    {
        while($row = mysqli_fetch_assoc($result)){
            $response[$i]['notification_id'] = $row['notification_id'];
            $response[$i]['user_id'] = $row['user_id'];
            $response[$i]['sender_id'] = $row['sender_id'];
            $response[$i]['notification_type'] = $row['notification_type'];
            $response[$i]['content'] = $row['content'];
            $response[$i]['is_read'] = $row['is_read'];
            $response[$i]['description'] = $row['description'];
            $response[$i]['created_at'] = $row['created_at'];
            $i++;
        }
        echo json_encode($response, JSON_PRETTY_PRINT);
    }
}
else{
    echo"tryagain dumbass";
}
?>
