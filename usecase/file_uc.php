<?php 
include_once('../config/import.php');

function createFile($userId, $type, $fileName) {
    try {
        $conn = callDb();
        $currentDate = currentTime();
        $idFile = uniqid();
        $sql = "INSERT INTO `file` (
            `file_id`,
            `type`,
            `file_name`,
            `created_at`
            ) VALUES (
                '$idFile',
                '$type', 
                '$fileName', 
                '$currentDate'
            )";
        $resultToken = $conn->query($sql);
        $data = new stdClass();
        $data->id = $idFile;
        $data->userId = $userId;
        $data->fileName = $fileName;
        $data->type = $type;
        $data->createdAt = $currentDate;
        return $data;
    } catch (Exception $e) {
        $error = $e->getMessage();
        response(500, "create file : $error");
    }
}
?>