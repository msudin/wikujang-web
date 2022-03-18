<?php
include_once('../helper/import.php');

function createDistrict($bodyRequest) {
    try {
        $conn = callDb();
        $currentDate = currentTime();
        $sql = "INSERT INTO district (
            `subdistrict_id`,
            `name`,
            `created_at`,
            `updated_at`,
            `deleted_at`
            ) VALUES (
                 $bodyRequest->subdistrictId,
                 '$bodyRequest->name',
                 '$currentDate',
                 '$currentDate',
                 ''
            )";
        $conn->query($sql);
        return true;
    } catch (Exception $e) {
        $error = $e->getMessage();
        response(500, "create district exception -> $error");
        return false;
    }
}

?>