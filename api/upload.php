<?php
include_once('../helper/import.php');

try {
    if(requestMethod() == "POST") {
        $dToken = validateToken(headerToken());
        if ($dToken != NULL) {
            if(isset($_FILES["image"]) && $_FILES["image"]["error"] == 0 && isset($_POST["type"])) {
                $typeImage = $_POST["type"];
                if ($typeImage == "profile" || $typeImage == "product" || $typeImage == "warung") {
                    $allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");
                    $filename = $_FILES["image"]["name"];
                    $filetype = $_FILES["image"]["type"];
                    $filesize = $_FILES["image"]["size"];
                    $filetemp = $_FILES["image"]["tmp_name"];

                    // verify file extension
                    $ext = pathinfo($filename, PATHINFO_EXTENSION);

                    // set max size image uploaded
                    $maxsize = 2 * 1024 * 1024;
                    if(!array_key_exists($ext, $allowed)) {
                        response(400, "Format image tidak diizinkan");
                        return;
                    } else if ($filesize > $maxsize) {
                        response(400, "Size image terlalu besar");
                        return;
                    } else {
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
                                $result = array(
                                    "id" => $dFile->id,
                                    "imageUrl" => urlPathImage()."".$basename,
                                    "imageName" => $basename,
                                    "type" => $dFile->type,
                                    "createdAt" => $dFile->createdAt
                                );
                                response(200, "Berhasil upload image", $result);
                            }
                            return;
                        }
                        response(500);
                        return;
                    }
                    return;
                } else {
                    response(500, "Type image not allowed");
                }
            } else {
                response(400, "File Not Found");
            }
            return;
        }
    }
    response(500);
} catch (Exception $e) {
    $error = $e->getMessage();
    response(500, "Upload image : $error");
}

?>