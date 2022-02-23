<?php 

function requestMethod() {
    return $_SERVER["REQUEST_METHOD"] ?? NULL;
}

function headerToken() {
    $headers = apache_request_headers();
    return $headers['Authorization'] ?? NULL;
}

function isEnvironmentLocal() {
    return true;
}

function serverName() {
    return "localhost";
}

function serverUserName() {
    if (isEnvironmentLocal()) {
        return "root";
    } else {
        return "id18502326_root";
    }
}

function serverDbPassword() {
    if (isEnvironmentLocal()) {
        return "";
    } else {
        return "Hostingerhostinger1234#";
    }
}

function serverDbName() {
    if (isEnvironmentLocal()) { 
        return "wikujang_db";
    } else {
        return "id18502326_wikujang";
    }
}

function urlPathImage() {
    if (isEnvironmentLocal()) {
        return "http://localhost:8080/wikujang/"."uploads/"; 
    } else {
        return serverName()."uploads/";
    }
}


?>