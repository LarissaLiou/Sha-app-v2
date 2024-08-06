<?php
$db_servername = "127.0.0.1:4306"; // for default: 127.0.0.1 
$db_username = "root"; // for x10: pjjabycm_ctfdb | for others: root
$db_password = ""; // for x10: q6sFckv3 
$db_name = "sociatedb2"; // for x10: pjjabycm_ctfdb 
$conn = new mysqli($db_servername,$db_username,$db_password,$db_name);

function prepared_query($mysqli, $sql, $params, $types = "")
{
    $stmt = $mysqli->prepare($sql);
    if ($stmt->bind_param($types, ...$params)===false){
        echo "parameter binding error";
    	return false;
    }
    if ($stmt->execute()===false){
        echo "Statement execution error";
    	return false;
    }
    return $stmt;
}

// if($conn){
//     echo "Connect is successfully";
// }

?>
