<?php 
include_once('../usecase/token_uc.php');
include_once('../usecase/user_uc.php');
include_once('../config/config.php');

try {
    $entityBody = file_get_contents('php://input');
    $entityData = json_decode($entityBody, true);    
    if ($entityBody != '' && ($entityData["token"] ?? null) != null) {
        $dToken = validateToken($entityData["token"]);
        if ($dToken != null) {
            $dUser = getUserById($dToken->userId);
            if($dUser != null) {
                response(200, "", $dUser);
            }
        }
    } else {
        response(500);
    }
} catch (Exception $e) {
    response(500, $e-getMessage());
}
?>