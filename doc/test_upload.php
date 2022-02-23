<?php 
include_once('../config/response.php');
include_once('../helper/utils.php');
include_once('../config/http.php');
include_once('../config/date_time.php');


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
        response(400, "format file not allowed");
    } else if ($filesize > $maxsize) {
        response(400, "Size to large", array("sizeImage" => $filesize, "allowedMaxSize" => (int)$maxsize));
    } else {

        // image env
        $local_image_url = 'http://localhost:8080/wikujang/'; 
        $dev_image_url = serverName();

        $path_server = $local_image_url;
        $server_url = $path_server."uploads"; 
        $imageUrl = $server_url;

        $target_dir = "../uploads/";
        $target_file = $target_dir . basename($filename);

        /* create new name file */
        $newfilename   = uniqid() . "-" . time();
        $extension  = pathinfo($filename, PATHINFO_EXTENSION );
        $basename   = $newfilename . "." . $extension;
        $new_target_file = $target_dir . basename($basename);

        $result = array(
            "id" => uniqid(),
            "urlImage" => $imageUrl."/".$basename,
            "imageName" => $basename, 
            "type" => $_POST["type"],
            "createdAt" => currentTime()
        );
        response(200, "Success upload image", $result);

        // if (move_uploaded_file($filetemp, $new_target_file)) {
        //     $result = array(
        //         "id" => uniqid(),
        //         "urlImage" => $imageUrl."/".$basename,
        //         "imageName" => $basename, 
        //         "createdAt" => currentTime()
        //     );
        //     response(200, "Success upload image", $result);
        // } else {
        //     response(500, "Sorry, there was an error uploading your file.");
        // }
        
    }
} else {
    response(500);
}
 
?>