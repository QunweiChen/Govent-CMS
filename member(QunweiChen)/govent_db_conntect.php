<?php
$servername="localhost";
$username="admin";
$password="12345";
$dbname="govent";

$conn = new mysqli($servername, $username, $password, $dbname);

if($conn->connect_error){
    die("連線失敗：".
    $conn->connect_error);
}else{
    // echo "資料庫連線成功";
}


