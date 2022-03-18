<?php 
include_once('../../helper/http.php');
date_default_timezone_set('Asia/Jakarta');

function callDb() {
    $servername = serverName();
    $username = serverUserName();
    $password = serverDbPassword();
    $db_name = serverDbName();

    try {
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
        $conn = new mysqli($servername,$username,$password,$db_name);
        return $conn;
    } catch (Exception $e) {
        $error = $e->getMessage();
        echo("error : $error");
        throw $e;
    }
}
?>
