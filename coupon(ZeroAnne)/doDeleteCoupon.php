<?php
require_once("./db_conntect_govent.php");

if(!isset($_GET["id"])) { 
    echo "請循正常管道進入此頁";
    die;  
}
$id = $_GET["id"];

$sql = "UPDATE coupon SET coupon_valid='0' WHERE id=$id";
// echo $sql;
// exit;

if ($conn->query($sql) === TRUE) {
    echo "刪除成功";
} else {
    echo "刪除資料錯誤: " . $conn->error;
}

$conn->close();
header("location:user-list.php");
