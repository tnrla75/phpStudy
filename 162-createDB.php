<?php
    $host = "localhost";
    $user = "root";
    $pw = "";

    $dbConnect = new mysqli($host, $user, $pw);

    $dbConnect -> set_charset("utf8");

//  test!!!!!!!!!!!

    if(mysqli_connect_errno()){
        echo "DB 접속 실패";
    }else {
        $sql = "CREATE DATABASE php200project";
        $res = $dbConnect->query($sql);
        echo "DB 접속 성공";
        if($res){
            echo "DB 생성 완료";
        }else{
            echo "DB 생성 실패";
        }
    }
?>
