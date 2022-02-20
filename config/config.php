<?php

function callDb() {
    try {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $db_name = "wikujang_db";
        $conn = new PDO("mysql:host=$servername;dbname=$db_name", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    } catch (PDOException $e) {
        throw $e;
    }
}

?>