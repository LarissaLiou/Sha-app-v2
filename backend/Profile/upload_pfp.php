<?php
require_once __dir__."/../Defaults/connect.inc.php";
require_once __dir__."/../Defaults/utils.inc.php";
require_once __dir__."/../Defaults/validate.inc.php";
function uploadImageFile($fileInputName, $targetDir, $baseDir, $mysqli)
{
    // Check if the file exists in $_FILES
    if (!isset($_FILES[$fileInputName]) || $_FILES[$fileInputName]['error'] != UPLOAD_ERR_OK) {
        onError($mysqli, "Error Uploading File!");
        return null;
    }

    $file = $_FILES[$fileInputName];

    // Validate file type (accepting only image files)
    $allowedMimeTypes = ['image/jpeg', 'image/png', 'image/gif'];
    $finfo = new finfo(FILEINFO_MIME_TYPE);
    $mimeType = $finfo->file($file['tmp_name']);
    if (!in_array($mimeType, $allowedMimeTypes)) {
        onError($mysqli, "Invalid File Type");
        return null;
    }

    // Validate file size (e.g., max 5MB)
    $maxFileSize = 5 * 1024 * 1024; // 5MB
    if ($file['size'] > $maxFileSize) {
        onError($mysqli, "File Size Too Large!");
        return null;
    }

    // Sanitize the original filename
    $originalName = basename($file['name']);
    $safeName = preg_replace("/[^a-zA-Z0-9\._-]/", "_", $originalName);

    // Generate a unique filename to avoid overwriting existing files
    $uniqueName = uniqid() . '_' . $safeName;
    $targetFilePath = rtrim($targetDir, '/') . '/' . $uniqueName;
    // remove trailing ..
    $baseFilePath = rtrim($baseDir,'/') .'/'. $uniqueName;
    // Ensure the target directory exists
    if (!is_dir($targetDir) && !mkdir($targetDir, 0755, true)) {
        onError($mysqli, "Internal Server Error");
        return null;
    }

    // Move the uploaded file to the target directory
    if (!move_uploaded_file($file['tmp_name'], $targetFilePath)) {
        onError($mysqli, "Internal Server Error");
        return null;
    }

    // Return the filename of the uploaded file
    return $baseFilePath;
}

function updateDatabase($filename, $userId, $mysqli){
    $sql = "UPDATE `user_details` SET `profile_picture` = ? WHERE `user_id` = ?";
    executeInsert($mysqli, $sql, "si", [$filename, $userId]);
}
if (!verify_login($mysqli)){
    onError($mysqli,"Unauthorized");
}

$targetDir = __dir__."/../../uploads/profiles";
$baseDir = "/Sha-app-v2/uploads/profiles";
$filename = uploadImageFile("pfp", $targetDir,$baseDir, $mysqli);
updateDatabase($filename, $_SESSION['userid'], $mysqli);
onSuccess($mysqli, "Profile Picture Uploaded", ["filename" => $filename]);
?>