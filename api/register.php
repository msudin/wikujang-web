<?php 
include_once('../usecase/user_exist_uc.php');
include_once('../usecase/token_uc.php');
include_once('../usecase/user_uc.php');
include_once('../config/response.php');

try {
    $entityBody = file_get_contents('php://input');
    $data = json_decode($entityBody, true);
    if ($entityBody != '') {
        $bodyRequest = new stdClass();
        $bodyRequest->fullName = $data['fullName'] ?? NULL;
        $bodyRequest->userName = $data['userName'] ?? NULL;
        $bodyRequest->phone = $data['phone'] ?? NULL;
        $bodyRequest->password = $data['password'] ?? NULL;
        $bodyRequest->email = $data['email'] ?? NULL;
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
        response(500, "body request can't empty");
    }
} catch (Exception $e) {
    response(500, $e->getMessage());
}
?>