<?php 
include('../config/import.php');

try {
    if(requestMethod() == "POST") {
        $dToken = validateToken(headerToken()); 
        if ($dToken != NULL) {
            if(isset($_FILES["image"]) && $_FILES["image"]["error"] == 0 && isset($_POST["type"])) { 
                $allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");
                $filename = $_FILES["image"]["name"];
                $filetype = $_FILES["image"]["type"];
                $filesize = $_FILES["image"]["size"]; 
                $filetemp = $_FILES["image"]["tmp_name"];
            
                // verify file extension
                $ext = pathinfo($filename, PATHINFO_EXTENSION);
            
                // set max size image uploaded
                $maxsize = 0.1 * 1024 * 1024;
                if(!array_key_exists($ext, $allowed)) {
                    response(400, "Format image not allowed");
                    return;
                } else if ($filesize > $maxsize) {
                    response(400, "Size image to large");
                    return;
                } else if ($_POST["type"] == "profile") {
                    // image env
                    $server_url = urlPathImage(); 
                    $target_dir = "../uploads/";
                    $target_file = $target_dir . basename($filename);
            
                    /* create new name file */
                    $newfilename   = uniqid() . "-" . time();
                    $extension  = pathinfo($filename, PATHINFO_EXTENSION );
                    $basename   = $newfilename . "." . $extension;
                    $new_target_file = $target_dir . basename($basename);
            
                    if (move_uploaded_file($filetemp, $new_target_file)) {
                        $dFile = createFile($dToken->userId, $_POST["type"], $basename);
                        if ($dFile != NULL) {
                            $breqProfile = new stdClass();
                            $breqProfile->userId = $dToken->userId;
                            $breqProfile->fileId = $dFile->id;
                            $dUpdateProfile = updateUserPhotoProfile($breqProfile);
                            if ($dUpdateProfile) {
                                $result = array(
                                    "id" => $dFile->id,
                                    "imageUrl" => $server_url."".$basename,
                                    "imageName" => $basename, 
                                    "type" => $dFile->type,
                                    "createdAt" => $dFile->createdAt
                                );
                                response(200, "Success upload image", $result);
                            }
                        }
                        return;
                    } 
                    response(500);
                    return;
                } 
                response(500);
                return;
            } 
            response(500);
            return;
        }
    } 
    response(500); 
} catch (Exception $e) {
    $error = $e->getMessage();
    response(500, "upload image : $error");
}

?>