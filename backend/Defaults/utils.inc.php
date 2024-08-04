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