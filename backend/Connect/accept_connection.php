<?php
require_once __dir__."/../Defaults/connect.inc.php";
require_once __dir__."/../Defaults/utils.inc.php";
require_once __dir__."/../Defaults/validate.inc.php";
function acceptRequest($mysqli,$request_id){
    
    $sql = "SELECT `user1_id`,`user2_id` FROM `connection_requests` WHERE `request_id` = ?";
    $connection = executeSelect($mysqli, $sql, "i", [$request_id]);
    if ($connection['data'][0]['user2_id'] != $_SESSION['userid']){
        onError($mysqli,"Unauthorized");
    }
    
    $sql = "INSERT INTO `connections` (`user1_id`,`user2_id`) VALUES (?,?)";
    executeInsert($mysqli, $sql, "ii", [$connection['data'][0]['user1_id'], $connection['data'][0]['user2_id']]);
    
    $sql = "DELETE FROM `connection_requests` WHERE `request_id` = ?";
    executeDelete($mysqli, $sql, "i", [$request_id]);
}