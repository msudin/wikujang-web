<?php 
include_once('../helper/import.php');

try {
    if (requestMethod() == "POST") { 
        $entityBody = file_get_contents('php://input');
        $data = json_decode($entityBody, true);

        $conn = callDb();
    
        /// DROP ALL DATA USER 
        $sqlUser = "DELETE FROM `user`";
        $conn->query($sqlUser);

        /// DROP ALL TOKEN 
        $sqlFile = "DELETE FROM `token`";
        $conn->query($sqlFile);

        /// DROP ALL DATA ADDRESS
        $sqlAdrress = "DELETE FROM `address`";
        $conn->query($sqlAdrress);

        /// DROP ALL FILE 
        $sqlFile = "DELETE FROM `file`";
        $conn->query($sqlFile);

        /// EXCLUDE DROP WITH CASE
        if ($entityBody != '') {

            // DROP ALL DATA ADMIN
            if (!empty($data["isDropAdmin"])) {
                if ($data['isDropAdmin'] == TRUE) { 
                    $sqlAdmin = "DELETE FROM `admin`";
                    $conn->query($sqlAdmin);
                }
            }
        }
        response(200, "Success Drop All Data");
    } else {
        response(500, "Method not allowed");
    }
} catch(Exception $e) {
    response(500, $e->getMessage());
}

?>