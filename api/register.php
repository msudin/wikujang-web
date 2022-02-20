<?php 
include '../usecase/register_uc.php';
include '../helper/response.php';

$entityBody = file_get_contents('php://input');
try {
    if ($entityBody != '') {
        $data = json_decode($entityBody, true);    
        $bodyRequest = new \stdClass();
        $bodyRequest->fullName = $data['fullName'];
        $bodyRequest->userName = $data['userName'];
        postRegister($bodyRequest);
    } else {
        response(500);
    }
} catch (PDOException $e) {
    response(500, $e->getMessage());
}

?>