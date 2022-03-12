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
?>