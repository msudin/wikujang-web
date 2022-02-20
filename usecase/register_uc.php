<?php
include '../config/config.php';

function postRegister($bodyRequest) {
    try {
        $conn = callDb();
        $sql = "INSERT INTO user (fullname, username) VALUES ('$bodyRequest->fullName', '$bodyRequest->userName')";
        $conn->exec($sql);
        response(200);
    } catch (PDOException $e) {
        response(500, $e->getMessage());
    }
}
?>