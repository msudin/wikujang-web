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
                $result = new stdClass();
                $result->accessToken = $dToken->accessToken;
                response(200, "", $dToken);
            }
        }
    }
} catch (Exception $e) {

}

?>