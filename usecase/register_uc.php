<?php
include_once('../config/config.php');
include_once('../config/date_time.php');


function postRegister($bodyRequest) {
    try {
        $conn = callDb();
        $currentDate = currentTime();
        $sql = "INSERT INTO user (`fullname`, `username`, `password`, `phone`, `created_at`, `updated_at`) VALUES ('$bodyRequest->fullName','$bodyRequest->userName', '$bodyRequest->password', '$bodyRequest->phone', '$currentDate', '$currentDate')";
        $conn->query($sql);
        return true;
    } catch (Exception $e) {
        $error = $e->getMessage();
        response(500, "postRegister exception -> $error");
        return false;
    }
}
?>