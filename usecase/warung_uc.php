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
            `updated_at`
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
                $body->subdistrictId,
                $body->districtId,
                '$body->address',
                '$body->latitude',
                '$body->longitude',
                '$currentDate',
                '$currentDate'
            )";
        $conn->query($sql);
        return true;
    } catch (Exception $e) {
        $error = $e->getMessage();
        response(500, "create warung exception -> $error");
        return false;
    }
}
?>