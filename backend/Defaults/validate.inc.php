<?php
function validateData($POST_GET, $filters, $validOptions, $presenceCheck,$jsonCheck = []){
    $inputData = filter_input_array($POST_GET, $filters);

    $errors = [];
    foreach ($inputData as $key => $value) {
        if ($value === null || $value === false) {
            $errors[] = "Invalid $key ".json_encode($_POST[$key]);
        }
        if (in_array($key, $jsonCheck) && !is_array(json_decode($value))) {
            print_r($key,$value);
            $errors[] = "Invalid JSON $key";
        }
        else if (in_array($key, $jsonCheck)) {
            $inputData[$key] = json_decode($value);
        }

        if (isset($validOptions[$key]) && !in_array($value, $validOptions[$key])) {
            $errors[] = "Invalid $key Option";
        }
        if (in_array($key, $presenceCheck) && empty($value)) {
            $errors[] = "Missing $key";
        }
        
    }
    if (count($errors) > 0) {
        error(implode(", ", $errors));
    }
    return $inputData;
}

function validateSecurity(bool $checkUser, $exitOnError = true){
    
    if ($checkUser){
        $userInfo = verify_login();
        if ($exitOnError && $userInfo === null){
            error("Unauthorized", 401);
        }
        return $userInfo;
    }
}

function error($error, $code = 400){
    http_response_code($code);
    echo json_encode(["error"=>$error]);
    exit();
}

function success($data){
    echo json_encode(["data"=>$data]);
    exit();
}