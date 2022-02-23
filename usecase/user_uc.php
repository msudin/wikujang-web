<?php 
include_once('../config/config.php');
include_once('../config/response.php');

function createUser($bodyRequest) {
    try {
        $conn = callDb();
        $currentDate = currentTime();
        $sql = "INSERT INTO user (
            `fullname`,
            `username`,
            `email`, 
            `password`,
            `phone`, 
            `created_at`,
            `updated_at`
            ) VALUES (
                 '$bodyRequest->fullName',
                 '$bodyRequest->userName', 
                 '$bodyRequest->email', 
                 '$bodyRequest->password',
                 '$bodyRequest->phone',
                 '$currentDate', 
                 '$currentDate'
            )";
        $conn->query($sql);
        return true;
    } catch (Exception $e) {
        $error = $e->getMessage();
        response(500, "create user exception -> $error");
        return false;
    }
}

function getUserByPhone($phone) {
    try {
        $connn = callDb();
        $sql = "SELECT * FROM user WHERE phone=$phone";
        $result = $connn->query($sql);
        if ($result->num_rows == 1) {
            while($row = $result->fetch_assoc()) {
                $data = new \stdClass();
                $data->id = (int)$row["user_id"];
                $data->phone = $row["phone"];
                $data->password = $row["password"];

                // $data->fullName = $row["fullname"];
                // $data->username = $row["username"];
                // $data->email = $row["email"];
                // $data->createdAt = $row["created_at"];
                // $data->updatedAt = $row["updated_at"];
                // $data->deletedAt = $row["deleted_at"];
                return $data;
            }
        } else {
            response(404, "phone number not registered");
            return NULL;
        }
    } catch (Exception $e) {
        $error = $e->getMessage();
        response(500, $error);
        return NULL;
    }
}

function getUserById($userId) {
    try {
        $connn = callDb();
        $server_url = urlPathImage(); 

        $sql = "SELECT f.file_id, f.file_name, u.*
        FROM `file` f 
        RIGHT JOIN `user` u ON f.file_id = u.profile_image_id 
        WHERE u.user_id=$userId
        ";

        $result = $connn->query($sql);
        if ($result->num_rows == 1) {
            while($row = $result->fetch_assoc()) {
                $data = new \stdClass();
                $data->id = (int)$row["user_id"];
                $data->email = $row["email"];
                $data->phone = $row["phone"];
                $data->fullName = $row["fullname"];
                $data->userName = $row["username"];
                $data->profileImageId = $row["file_id"];

                if (!isNullOrEmptyString($row['file_name'])) {
                    $data->profileImageUrl = $server_url."".$row['file_name'];
                } else {
                    $data->profileImageUrl = $row['file_name'];
                }

                $data->createdAt = $row["created_at"];
                $data->updatedAt = $row["updated_at"];
                $data->deletedAt = $row["deleted_at"];
                return $data;
            }
        } else {
            response(404);
            return NULL;
        }
    } catch (Exception $e) {
        $error = $e->getMessage();
        response(500, "$error");
        return NULL;
    }
}

function updateUserPhotoProfile($bodyRequest) {
    try {
        $conn = callDb();
        $updatedAt = currentTime();
        $sql = "UPDATE user SET 
            `profile_image_id`= '$bodyRequest->fileId',
            `updated_at` = '$updatedAt'
        WHERE `user_id`= $bodyRequest->userId";
        $conn->query($sql);
        return true;
    } catch (Exception $e) {
        $error = $e->getMessage();
        response(500, "create user exception -> $error");
        return false;
    }
}

?>