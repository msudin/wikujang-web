<?php 
include_once('../usecase/user_uc.php');
include_once('../usecase/token_uc.php');

try {
    $entityBody = file_get_contents('php://input');
    $entityData = json_decode($entityBody, true);    
    if ($entityBody != '' && ($entityData["phone"] ?? null) != null) {
        $dUser = getUserByPhone($entityData["phone"]);
        if ($dUser != null) {
            $dToken = getTokenById($dUser->id);
            if ($dToken != null) {
                $dLogin = new stdClass();
                $dLogin->userId = $dToken->userId;
                $dLogin->accessToken = $dToken->accessToken;
                $dLogin->expiredAt = $dToken->expiredAt;
                response(200, "", $dLogin);
            }
        }
    }
} catch (Exception $e) {
    $error = $e->getMessage();
    response(500, "login exception : $error");
}

?>