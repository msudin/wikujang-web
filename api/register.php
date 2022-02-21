<?php 
include_once('../usecase/user_exist_uc.php');
include_once('../usecase/register_uc.php');
include_once('../usecase/token_uc.php');
include_once('../usecase/user_uc.php');
include_once('../config/response.php');

try {
    $entityBody = file_get_contents('php://input');
    $data = json_decode($entityBody, true);
    if ($entityBody != '') {
        $bodyRequest = new stdClass();
        $bodyRequest->fullName = $data['fullName'] ?? null;
        $bodyRequest->userName = $data['userName'] ?? null;
        $bodyRequest->phone = $data['phone'] ?? null;
        $bodyRequest->password = $data['password'] ?? null;
        $bodyRequest->email = $data['email'] ?? null;
        if (!(registerCheckUserExist($bodyRequest->email, $bodyRequest->userName, $bodyRequest->phone))) {
           $isSuccessCreateUser = postRegister($bodyRequest);
           if($isSuccessCreateUser) {
               $userData = getUserByPhone($bodyRequest->phone);
               if ($userData != null) {
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