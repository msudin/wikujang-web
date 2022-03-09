<?php 
include_once('../helper/import.php');

function registerCheckUserExist($phone, $password) {
    try {
        if (isNullOrEmptyString($phone)) {
            response(400, "phone can't empty" );
            return true; 
        } else if (isNullOrEmptyString($password)) {
            response(400, "password can't empty" );
            return true; 
        } else {
            $conn = callDb();
            $sqlPhone = "SELECT * FROM user WHERE phone=$phone";
            $resultPhone = $conn->query($sqlPhone);
            
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