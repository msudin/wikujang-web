<?php 
include_once('../helper/import.php');

try {
    if (requestMethod() == "POST") { 
        $entityBody = file_get_contents('php://input');
        $data = json_decode($entityBody, true);
        if ($entityBody != '') {
            $bodyRequest = new stdClass();
            $bodyRequest->fullName = $data['fullName'] ?? NULL;
            $bodyRequest->userName = $data['userName'] ?? NULL;
            $bodyRequest->phone = $data['phone'] ?? NULL;
            $bodyRequest->password = $data['password'] ?? NULL;
            $bodyRequest->email = $data['email'] ?? NULL;
            $bodyRequest->birthdate = $data['birthdate'] ?? "2022-02-27";
            $bodyRequest->gender = $data["gender"] ?? "L";
            if (!(registerCheckUserExist($bodyRequest->phone, $bodyRequest->password))) {
               $isSuccessCreateUser = createUser($bodyRequest);
               if($isSuccessCreateUser) {
                   $userData = getUserByPhone($bodyRequest->phone);
                   if ($userData != NULL) {
                       createToken($userData->id);
                   }
               }
            }
        } else {
            response(400);
        }  
    } else {
        response(500, "Method not allowed");
    }
} catch (Exception $e) {
    response(500, $e->getMessage());
}
?>