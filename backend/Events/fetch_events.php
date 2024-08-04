<?php
$con = mysqli_connect("localhost","root","","sociatedb");
$response = array();
if($con){
    $sql = "select * from events";
    $result = mysqli_query($con,$sql);
    if(mysqli_num_rows($result)>0)
    header('Content-type: application/json');
    {
        while($row = mysqli_fetch_assoc($result)){
            $response[$i]['event_id'] = $row['event_id'];
            $response[$i]['event_name'] = $row['event_name'];
            $response[$i]['min_price'] = $row['min_price'];
            $response[$i]['max_price'] = $row['max_price'];
            $response[$i]['min_attendees'] = $row['min_attendees'];
            $response[$i]['max_attendees'] = $row['max_atttendees'];
            $response[$i]['description'] = $row['description'];
            $response[$i]['location'] = $row['location'];
            $response[$i]['start'] = $row['start'];
            $response[$i]['end'] = $row['end'];
            $i++;
        }
        echo json_encode($response, JSON_PRETTY_PRINT);
    }
}
else{
    echo"tryagain dumbass";
}
?>
