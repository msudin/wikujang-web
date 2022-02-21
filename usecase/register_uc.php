<?php
include_once('../config/config.php');
include_once('../config/date_time.php');
include_once('../config/response.php');


function postRegister($bodyRequest) {
    try {
        $conn = callDb();
        $currentDate = currentTime();
        $sql = "INSERT INTO user (`fullname`, `username`, `email`, `password`, `phone`, `created_at`, `updated_at`) VALUES ('$bodyRequest->fullName', '$bodyRequest->userName',  '$bodyRequest->email', '$bodyRequest->password', '$bodyRequest->phone', '$currentDate', '$currentDate')";
        $conn->query($sql);
        return true;
    } catch (Exception $e) {
        $error = $e->getMessage();
        response(500, "postRegister exception -> $error");
        return false;
    }
}
?>