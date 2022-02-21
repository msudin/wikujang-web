<?php 
include_once('../config/config.php');
include_once('../helper/response.php');

function getUserByPhone($phone) {
    try {
        $connn = callDb();
        $sql = "SELECT * FROM user WHERE phone=$phone";
        $result = $connn->query($sql);
        if ($result->num_rows == 1) {
            while($row = $result->fetch_assoc()) {
                $data = new stdClass();
                $data->id = $row["id"];
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
            response(400, "user by phone $phone not found");
            return null;
        }
    } catch (Exception $e) {
        $error = $e->getMessage();
        response(500, "getUserByPhone exception -> $error");
        return null;
    }
}
?>