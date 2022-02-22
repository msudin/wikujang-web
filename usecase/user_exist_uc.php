<?php 
include_once('../config/config.php');
include_once('../config/response.php');
include_once('../helper/utils.php');

function registerCheckUserExist($phone, $password) {
    try {
        if (isNullOrEmptyString($phone)) {
            response(400, "password can't empty" );
            return true; 
        } else if (isNullOrEmptyString($password)) {
            response(400, "phone can't empty" );
            return true; 
        } else {
            $conn = callDb();
            $sqlPhone = "SELECT * FROM user WHERE phone LIKE '%$phone%'";
            $resultPhone = $conn->query($sqlPhone);

            // $sqlEmail = "SELECT * FROM user WHERE email LIKE '%$email%'";
            // $resultEmail = $conn->query($sqlEmail);

            // if($resultEmail->num_rows > 0) {
            //     response(400, "email already exist" );
            //     return true;
            // } else {}
            
            if ($resultPhone->num_rows > 0) {
                response(400, "phone already exist" );
                return true;
            } else {
                return false;
            }
        }
    } catch (Exception $e) {
        $error = $e->getMessage();
        response(500, "user exist exception -> $error");
        return true;
    }    
}
?>