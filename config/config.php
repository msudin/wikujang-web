<?php

function callDb() {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $db_name = "wikujang_db";

    try {
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
        $conn = new mysqli($servername,$username,$password,$db_name);
        return $conn;
    } catch (Exception $e) {
        throw $e;
    }
}
?>