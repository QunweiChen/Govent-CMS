<?php
require_once("./db_conntect_govent.php");

if (!isset($_POST["name"])) {
    echo "請循正常管道進入";
    die;
}
if (!isset($_POST["couponValid"], $_POST["discountType"])) {
    echo "請輸入資料";
    die;
}

$code = $_POST["code"];
$name = $_POST["name"];
$couponValid = $_POST["couponValid"];
$discountType = $_POST["discountType"];
$discountValid = $_POST["discountValid"];
$startAt = $_POST["startAt"];
$expiresAt = $_POST["expiresAt"];
$priceMin = $_POST["priceMin"];
$maxUsage = $_POST["maxUsage"];
$activityNum = $_POST["activityNum"];

if (empty($code) || empty($name) || empty($couponValid) || empty($discountType) || empty($discountValid) || empty($startAt) || empty($expiresAt) || empty($priceMin) || empty($maxUsage) || empty($activityNum)) {
    echo "請輸入資料";
    die;
}

//echo "$couponValid,$discountType,$code,$name,$discountValid,$startAt,$expiresAt,$priceMin,$maxUsage,$activityNum";

$sql = "INSERT INTO coupon (coupon_code, coupon_name, coupon_valid, discount_type, discount_valid, start_at, expires_at, price_min, max_usage, activity_num )
VALUES ('$code', '$name', '$couponValid', '$discountType', '$discountValid', '$startAt', '$expiresAt', '$priceMin', '$maxUsage', '$activityNum')";

if ($conn->query($sql) === TRUE) {
    echo "新增資料完成";
    $last_id=$conn->insert_id; //抓新增id名
    echo "最新一筆序號".$last_id;

} else {
    echo "新增資料錯誤: " . $conn->error;
}
$conn->close();

