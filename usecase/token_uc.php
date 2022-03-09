<?php 
include_once('../helper/import.php');

function generateToken() {
    return bin2hex(openssl_random_pseudo_bytes(16));
}

function createToken($userid) {
    try {
        $conn = callDb();
        $token = generateToken();
        $currentDate = currentTime();
        $expiredDate = customTimeAdd($currentDate, 5);
        $sql = "INSERT INTO token (
            `user_id`,
            `access_token`, `created_at`, 
            `expired_at`
            ) VALUES (
                $userid,
                '$token',
                '$currentDate',
                '$expiredDate'
            )";
        $resultToken = $conn->query($sql);

        $data = new stdClass();
        $data->accessToken = $token;
        $data->createdAt = $currentDate;
        $data->expiredAt = $expiredDate;
        
        //$data->userId = $userid;
        //$dUser = getUserById($userid);
        //if ($dUser != null) {
        //    $data->fullName = $dUser->fullName;
        //    $data->userName = $dUser->userName;
        //}
        
        response(200, "register successfully", $data);
    } catch (Exception $e) {
        $error = $e->getMessage();
        response(500, "createToken exception -> $error");
    }
}

function getTokenById($userId) {
    try {
        $conn = callDb();
        $sqlToken = "SELECT * FROM token WHERE user_id=$userId";
        $result = $conn->query($sqlToken);
        $data = new stdClass();
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $data->userId = $row["user_id"];
                $data->accessToken = $row["access_token"];
                $data->createdAt = $row['created_at'];
                $data->expiredAt = $row["expired_at"];
                return $data;
            }
        } else {
            response(400);
            return NULL;
        }
    } catch (Exception $e) {
        $error = $e->getMessage();
        response(500, "validateSession exc : $error");
        return NULL;
    }
}

function validateToken($accessToken) {
    try {
        if (!isNullOrEmptyString($accessToken)) {
            $conn = callDb();
            $sqlToken = "SELECT * FROM token WHERE access_token='$accessToken'";
            $result = $conn->query($sqlToken);
            $data = new stdClass();
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $data->userId = (int)$row["user_id"];
                    $data->accessToken = $row["access_token"];
                    $data->createdAt = $row["created_at"];
                    $data->expiredAt = $row["expired_at"];
                    return $data;
                }
            } else {
                response(401);
                return NULL;
            }
        } else {
            response(401);
            return NULL;
        }
    } catch (Exception $e) {
        $error = $e->getMessage();
        response(500, "validate token exc : $error");
        return NULL;
    }
}
?>