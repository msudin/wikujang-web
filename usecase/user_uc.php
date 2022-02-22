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
                $data->id = (int)$row["id"];
                $data->fullName = $row["fullname"];
                $data->username = $row["username"];
                $data->email = $row["email"];
                $data->phone = $row["phone"];
                $data->createdAt = $row["created_at"];
                $data->updatedAt = $row["updated_at"];
                $data->deletedAt = $row["deleted_at"];
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
        $sql = "SELECT * FROM user WHERE id=$userId";
        $result = $connn->query($sql);
        if ($result->num_rows == 1) {
            while($row = $result->fetch_assoc()) {
                $data = new \stdClass();
                $data->id = (int)$row["id"];
                $data->fullName = $row["fullname"];
                $data->username = $row["username"];
                $data->email = $row["email"];
                $data->phone = $row["phone"];
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
?>