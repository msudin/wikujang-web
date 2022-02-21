<?php 
include_once('../config/config.php');
include_once('../helper/response.php');

function registerCheckUserExist($email, $username, $phone) {
    try {
        $conn = callDb();
        $sqlEmail = "SELECT * FROM user WHERE email LIKE '%$email%'";
        $resultEmail = $conn->query($sqlEmail);

        $sqlPhone = "SELECT * FROM user WHERE phone LIKE '%$phone%'";
        $resultPhone = $conn->query($sqlPhone);

        $sqlUsername = "SELECT * FROM user WHERE username LIKE '%$username%'";
        $resultUsername = $conn->query($sqlUsername);

        if($resultEmail->num_rows > 0) {
            response(400, "email already exist" );
            return true;
        } else if ($resultPhone->num_rows > 0) {
            response(400, "phone already exist" );
            return true;
        } else if ($resultUsername->num_rows > 0) {
            response(400, "username already exist" );
            return true;
        } else {
            return false;
        }
    } catch (Exception $e) {
        $error = $e->getMessage();
        response(500, "registerCheckUserExist exception -> $error");
        return true;
    }    
}
?>