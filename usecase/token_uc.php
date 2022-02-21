<?php 
include_once('../config/config.php');
include_once('../config/date_time.php');
include_once('../helper/response.php');

function generateToken() {
    return bin2hex(openssl_random_pseudo_bytes(32));
}

function createToken($userid) {
    try {
        $conn = callDb();
        $token = generateToken();
        $currentDate = currentTime();
        $expiredDate = customTimeAdd($currentDate, 5);
        $sql = "INSERT INTO token (user_id, access_token, created_at, expired_at) VALUES ($userid, '$token', '$currentDate', '$expiredDate')";
        $resultToken = $conn->query($sql);

        $data = new stdClass();
        $data->accessToken = $token;
        $data->createdAt = $currentDate;
        $data->expiredAt = $expiredDate;
        $data->userId = $userid;
        if($resultToken === TRUE) {
            $sqlUser = "SELECT fullname, username FROM user WHERE id=$userid";
            $result = $conn->query($sqlUser);
            if ($result->num_rows == 1) {
                while($row = $result->fetch_assoc()) {
                    $data->fullName = $row["fullname"];
                    $data->userName = $row["username"];
                }
            }
        } 
        response(200, "register successfully", $data);
    } catch (Exception $e) {
        $error = $e->getMessage();
        response(500, "exception -> $error");
    }
}
?>