<?php
include_once('../helper/import.php');

function createSubdistrict($bodyRequest) {
    try {
        $conn = callDb();
        $currentDate = currentTime();
        $sql = "INSERT INTO subdistrict (
            `subdistrict_id`,
            `name`,
            `postal_code`,
            `created_at`,
            `updated_at`
            ) VALUES (
                $bodyRequest->id,
                '$bodyRequest->name',
                '$bodyRequest->postalCode',
                '$currentDate',
                '$currentDate'
            )";
        $conn->query($sql);
        return true;
    } catch (Exception $e) {
        $error = $e->getMessage();
        response(500, "create subdistrict exception -> $error");
        return false;
    }
}

?>