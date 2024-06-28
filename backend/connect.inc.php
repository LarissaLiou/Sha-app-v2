<?php
$servername = "127.0.0.1"; // for default: 127.0.0.1 
$username = "root"; // for x10: pjjabycm_ctfdb | for others: root
$password = ""; // for x10: q6sFckv3 
$db_name = "sociatedb"; // for x10: pjjabycm_ctfdb 
$conn = new mysqli($servername,$username,$password,$db_name);

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
?>