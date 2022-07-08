<?php
include_once('../helper/import.php');

function getTotalUser() {
    $conn = callDb();
    $sqlCountUser = "SELECT COUNT(user_id) AS TotalUser FROM user";
    $result = $conn->query($sqlCountUser);
    while($row = $result->fetch_assoc()) {
        return $row["TotalUser"];
    }
}


function getListUser($limit = 0) {
    $conn = callDb();
    $array = array();

    if (!empty($limit)) {
        $limitData = (int)$limit;
        $sqlAllUser = "SELECT * FROM `user` ORDER BY `created_at` DESC LIMIT $limitData";
    } else {
        $sqlAllUser = "SELECT * FROM `user` ORDER BY `created_at` DESC";
    }

    $result = $conn->query($sqlAllUser);
    while($row = $result->fetch_assoc()) {
        $data = new stdClass();
        $data->userId = $row['user_id'];
        $data->fullName = $row['fullname'];
        $data->createdAt = $row['created_at'];
        $data->role = $row['role'];
        array_push($array, $data);
    }
    return $array;
}
?>