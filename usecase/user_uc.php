<?php
include_once('../helper/import.php');

function createUserRegister($bodyRequest) {
    try {
        $conn = callDb();
        $currentDate = currentTime();
        $sql = "INSERT INTO user (
            `fullname`,
            `username`,
            `email`,
            `password`,
            `phone`,
            `birthdate`,
            `gender`,
            `active`,
            `role`,
            `created_at`,
            `updated_at`,
            `deleted_at`
            ) VALUES (
                 '$bodyRequest->fullName',
                 '$bodyRequest->userName',
                 '$bodyRequest->email',
                 '$bodyRequest->password',
                 '$bodyRequest->phone',
                 '$bodyRequest->birthdate',
                 '$bodyRequest->gender',
                 'true',
                 'user',
                 '$currentDate',
                 '$currentDate',
                 ''
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
                $data->isActive = filter_var($row['active'], FILTER_VALIDATE_BOOLEAN);
                $data->role = $row['role'];
                $data->fullName = $row['fullname'];
                $data->userName = $row['username'];
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

        $sql = "SELECT f.file_id, f.type, f.file_name, ad.address_id, ad.subdistrict_id, ad.district_id, ad.address_detail, u.* FROM `user` u 
        LEFT JOIN `file` f ON u.image_id = f.file_id 
        LEFT JOIN `address` ad ON u.address_id = ad.address_id 
        WHERE u.user_id=$userId";

        $result = $connn->query($sql);
        if ($result->num_rows == 1) {
            while($row = $result->fetch_assoc()) {
                $data = new stdClass();
                $data->id = (int)$row["user_id"];
                $data->email = $row["email"];
                $data->phone = $row["phone"];
                $data->fullName = $row["fullname"];
                $data->userName = $row["username"];
                $data->birthdate = $row['birthdate'];
                $data->gender = $row['gender'];
                $data->profileImage = NULL;
                if (!isNullOrEmptyString($row["file_id"])) {
                    $photo = new stdClass();
                    $photo->id = $row["file_id"];
                    $photo->imageUrl = urlPathImage()."".$row['file_name'];
                    $data->profileImage = $photo;
                }
                $data->address = NULL;
                if (!isNullOrEmptyString($row["address_id"])) {
                    $address = new stdClass();
                    $address->districtId = 1121;
                    $address->districtName = "Pasuruan";
                    $address->subDistrictId = 123123;
                    $address->subDistrictName = "Ngabar";
                    $address->description = "Jl Kemana Saja";
                    $data->address = $address;
                }
                $data->isActive = filter_var($row['active'], FILTER_VALIDATE_BOOLEAN);
                $data->role = $row['role'];
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
            `image_id`= '$bodyRequest->fileId',
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

function updateUserRole($bodyRequest) {
    try {
        $conn = callDb();
        $updatedAt = currentTime();
        $sql = "UPDATE user SET
            `role`= '$bodyRequest->role',
            `updated_at` = '$updatedAt'
        WHERE `user_id`= $bodyRequest->userId";
        $conn->query($sql);
        return true;
    } catch (Exception $e) {
        $error = $e->getMessage();
        response(500, "user exception -> $error");
        return false;
    }
}

?>