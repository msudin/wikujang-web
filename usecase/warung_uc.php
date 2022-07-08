<?php
include_once('../helper/import.php');

function getTotalWarung() {
    $conn = callDb();
    $sqlCountUser = "SELECT COUNT(user_id) AS TotalUser FROM user WHERE `role`='warung'";
    $result = $conn->query($sqlCountUser);
    while($row = $result->fetch_assoc()) {
        return $row["TotalUser"];
    }
}


function getListWarung($limit = 0) {
    $conn = callDb();
    $array = array();

    if (!empty($limit)) {
        $limitData = (int)$limit;
        $sqlAllUser = "SELECT * FROM `warung` ORDER BY `created_at` DESC LIMIT $limitData";
    } else {
        $sqlAllUser = "SELECT * FROM `warung` ORDER BY `created_at` DESC";
    }

    $result = $conn->query($sqlAllUser);
    while($row = $result->fetch_assoc()) {
        $data = new stdClass();
        $data->name = $row['name'];
        $data->createdAt = $row['created_at'];
        $data->isOpen = $row['is_open'];
        $data->openTime = $row['open_time'];
        $data->closedTime = $row['closed_time'];
        array_push($array, $data);
    }
    return $array;
}
?>