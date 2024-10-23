<?php
function onError($conn,$error,$additionalData = []) {
    
    $data = array_merge(["error"=>$error],$additionalData); 
    echo json_encode($data, JSON_FORCE_OBJECT);
    mysqli_close($conn);
    exit();
}

function onSuccess($conn,$success,$additionalData = []){
    $data = array_merge(["success"=>$success],$additionalData);
    echo json_encode($data);
    mysqli_close($conn);
    exit();
}

function generateColor($interest){
    $hash = md5($interest);
    return "#" . substr($hash, 0, 6);
}   

function utf8ize($d) {
    if (is_array($d)) {
        foreach ($d as $k => $v) {
            $d[$k] = utf8ize($v);
        }
    } else if (is_string ($d)) {
        return mb_convert_encoding($d, "UTF-8", 'ISO-8859-1');
    }
    return $d;
}