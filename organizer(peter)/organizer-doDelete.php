<?php
require_once("../connect_server.php");

$id = $_GET["id"];

$sql = "UPDATE organizer SET valid = 0 WHERE id = $id";


if ($conn->query($sql) === TRUE) {
    echo "更新資料完成";
} else {
    echo "新增資料錯誤: " . $conn->error;
}
$conn->close();

header("location: organizer-list.php");