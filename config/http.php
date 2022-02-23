<?php 

function requestMethod() {
    return $_SERVER["REQUEST_METHOD"] ?? NULL;
}

function headerToken() {
    $headers = apache_request_headers();
    return $headers['Authorization'] ?? NULL;
}

function serverName() {
    return "localhost";
}

function serverUserName() {
    return "root";
}

function serverDbPassword() {
    return "";
}

function serverDbName() {
    return "wikujang_db";
}

function urlImageLocal() {
   return "http://localhost:8080/wikujang/"."uploads/"; 
}

function urlImageDev() {
    return serverName()."uploads/";
}

?>