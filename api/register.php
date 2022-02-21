<?php 
include_once('../usecase/user_exist_uc.php');
include_once('../usecase/register_uc.php');
include_once('../usecase/token_uc.php');
include_once('../usecase/user_uc.php');

$entityBody = file_get_contents('php://input');
try {
    if ($entityBody != '') {
        $data = json_decode($entityBody, true);    
        $bodyRequest = new stdClass();
        $bodyRequest->fullName = $data['fullName'];
        $bodyRequest->userName = $data['userName'];
        $bodyRequest->phone = $data['phone'];
        $bodyRequest->password = $data['password'];
        $bodyRequest->email = $data['email'];
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
} catch (PDOException $e) {
    response(500, $e->getMessage());
}
?>