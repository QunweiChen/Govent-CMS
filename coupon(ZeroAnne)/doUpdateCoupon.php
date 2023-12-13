<?php
require_once("../connect_server.php");

if (!isset($_POST["name"])) {
    echo "請循正常管道進入此頁";
    exit;
}
$id = $_POST["id"];
$name = $_POST["name"];
$couponValid = $_POST["couponValid"];
$discountType = $_POST["discountType"];
$discountValid = $_POST["discountValid"];
$startAt = $_POST["startAt"];
$expiresAt = $_POST["expiresAt"];
$priceMin = $_POST["priceMin"];
$maxUsage = $_POST["maxUsage"];
$activityNum = $_POST["activityNum"];

$sql = "UPDATE coupon SET coupon_name='$name', coupon_valid='$couponValid', discount_type='$discountType', 
discount_valid='$discountValid', start_at='$startAt', expires_at='$expiresAt', price_min='$priceMin',  max_usage='$maxUsage', activity_num='$activityNum' 
WHERE id='$id'";



if ($conn->query($sql) === TRUE) {
    echo "更新成功";
} else {
    echo "更新資料錯誤: " . $conn->error;
}

$conn->close();

header("location:coupon.php?id=$id");
