<?php
include_once('../helper/import.php');

function createWarung($body) {
    try {
        $conn = callDb();
        $currentDate = currentTime();
        $sql = "INSERT INTO warung (
            `warung_id`,
            `user_id`,
            `name`,
            `username`,
            `description`,
            `is_open`,
            `open_time`,
            `closed_time`,
            `rating`,
            `image_id`,
            `subdistrict_id`,
            `district_id`,
            `address`,
            `latitude`,
            `longitude`,
            `created_at`,
            `updated_at`,
            `deleted_at`
            ) VALUES (
                '$body->id',
                $body->userId,
                '$body->name',
                '$body->userName',
                '$body->description',
                '$body->isOpen',
                '$body->openTime',
                '$body->closedTime',
                $body->rating,
                '$body->imageId',
                $body->subDistrictId,
                $body->districtId,
                '$body->address',
                '$body->latitude',
                '$body->longitude',
                '$currentDate',
                '$currentDate',
                ''
            )";
        $conn->query($sql);
        return true;
    } catch (Exception $e) {
        $error = $e->getMessage();
        response(500, "create warung exception -> $error");
        return false;
    }
}

function getAllWarung() {
    try {
        $conn = callDb();
        $array = array();

        $sql = "SELECT f.*, w.*
        FROM `file` f
        RIGHT JOIN `warung` w ON f.file_id = w.image_id";
        $result = $conn->query($sql);
        while($row = $result->fetch_assoc()) {
            $data = new stdClass();
            $data->id = $row['warung_id'];
            $data->userId = (int)$row['user_id'];
            $data->name = $row['name'];
            $data->username = $row['username'];
            $data->description = $row['description'];
            $data->isOpen = filter_var($row['is_open'], FILTER_VALIDATE_BOOLEAN);
            $data->openTime = $row['open_time'];
            $data->closedTime = $row['closed_time'];
            $data->rating = $row['rating'];
            $data->rating = $row['rating'];
            $data->imageId = $row['image_id'];
            $data->imageUrl = "";
            if (!empty($data->imageId)) {
                $data->imageUrl = urlPathImage()."".$row["file_name"];
            }
            $data->latitude = $row['latitude'];
            $data->longitude = $row['longitude'];
            $data->createdAt = $row['created_at'];
            $data->updatedAt = $row['updated_at'];
            $data->deletedAt = $row['deleted_at'];
            array_push($array, $data);
        }
        $resultData = new stdClass();
        $resultData->success = true;
        $resultData->data = $array;
        return $resultData;
    } catch (Exception $e) {
        $error = $e->getMessage();
        response(500, "get all warung exception -> $error");

        $resultData = new stdClass();
        $resultData->success = false;
        $resultData->data = NULL;
        return $resultData;
    }
}
?>