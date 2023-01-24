<?php
    $host = "localhost";
    $user = "root";
    $pw = "";
    $dbName = "php200project";
    $dbConnect = new mysqli($host, $user, $pw, $dbName);
    $dbConnect ->set_charset("utf8");

    if(mysqli_connect_errno()) echo "DB 접속 실패";
?>