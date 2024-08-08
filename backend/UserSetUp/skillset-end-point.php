<?php
session_start();
require_once __dir__."/../Defaults/connect.inc.php";
require_once __dir__."/../Defaults/utils.inc.php";
require_once __dir__."/../Defaults/validate.inc.php";
function insertSkillSetIfNotExists($conn, $interest){
    // BADDDDD implementation. Will change in future
    $sql = 'SELECT `skillset_id` FROM skillsets WHERE skillset = ?';
    $res = executeSelect($conn, $sql, 's', [$interest]);
    $skillset_id = null;
    if ($res['num_rows'] == 0){
        $sql = "INSERT INTO skillsets (skillset) VALUES (?)";
        $res = executeInsert($conn, $sql, 's', [$interest]);
        $skillset_id = $res['insertedId'];
    }
    else{
        $skillset_id = $res['data'][0]['interest_id'];
    }
    return $skillset_id;
}


if (!verify_login($mysqli)){
    onError($mysqli,"Unauthorized");
}


$skillset = $_POST['selectedSkillset'];
$skillset = json_decode($skillset);
$user_id = $_SESSION['userid'];

for ($i = 0; $i < count($skillset); $i++){
    $skillset_id = insertSkillSetIfNotExists($mysqli, $skillset[$i]);
    $sql = 'INSERT IGNORE INTO users_skillset_junction (user_id, skillset_id) VALUES (?, ?)';
    $res = executeInsert($mysqli, $sql, 'ii', [$user_id, $skillset_id]);
}


header('Location: ../../index.php?filename=home');
?>