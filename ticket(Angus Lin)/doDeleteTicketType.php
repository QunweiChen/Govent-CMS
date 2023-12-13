<?php

require_once("../connect_server.php");

if(!isset($_GET["id"])){
    header("Location:404.php");
    exit;
}

$id=$_GET["id"];
$category=$_GET["category"];
$page=$_GET["page"];

// var_dump($id);

$sql="UPDATE ticket_type SET valid='1' WHERE id=$id";

if ($conn->query($sql) === TRUE){
    echo "刪除成功";
}else{
    echo "刪除資料錯誤". $conn->error;
}


$conn->close();

if (isset($_GET["page"]) && isset($_GET["category"])) {
    header("Location: ticket-list.php?page=$page&category=$category");
} elseif (isset($_GET["page"])) {
    header("Location: ticket-list.php?page=$page");
} elseif (isset($_GET["category"])) {
    header("Location: ticket-list.php?category=$category");
} else {
    header("Location: ticket-list.php");
}

?>