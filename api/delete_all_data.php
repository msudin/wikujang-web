<?php 
include_once('../helper/import.php');

try {
    if (requestMethod() == "DELETE") { 
        $conn = callDb();
    
        /// DROP ALL DATA USER 
        $sqlUser = "DELETE FROM `user`";
        $conn->query($sqlUser);

        /// DROP ALL DATA ADDRESS
        $sqlAdrress = "DELETE FROM `address`";
        $conn->query($sqlAdrress);

        /// DROP ALL FILE 
        $sqlFile = "DELETE FROM `file`";
        $conn->query($sqlFile);

        /// DROP ALL TOKEN 
        $sqlFile = "DELETE FROM `token`";
        $conn->query($sqlFile);

        response(200, "Success Drop All Data");
    } else {
        response(500, "Method not allowed");
    }
} catch(Exception $e) {
    response(500, $e->getMessage());
}

?>