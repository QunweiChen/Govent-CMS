<?php
require_once("./db_conntect_govent.php");

if (!isset($_GET["id"])) {
    echo "請循正常管道進入此頁";
    die;
}
$id = $_GET["id"];
$search = $_GET["search"];

$sql = "UPDATE coupon SET coupon_valid='-1' WHERE id=$id";
// echo $sql;
// exit;

if ($conn->query($sql) === TRUE) {
    echo "刪除成功";
} else {
    echo "刪除資料錯誤: " . $conn->error;
}

$conn->close();
if (isset($_GET["use"])) {
    $use = $_GET["use"];
    header("location:coupon-list.php?page=$page&order=$order&use=$use");
} elseif(isset($_GET["page"]) && $_GET["order"] ) {
    $page = $_GET["page"];
    $order = $_GET["order"];
    header("location:coupon-list.php?page=$page&order=$order");
}else{
        $search = $_GET["search"];
        var_dump($search);
        header("location:coupon-list.php?page=1&order=1");
}
